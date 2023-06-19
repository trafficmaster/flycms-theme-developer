<?php

namespace App\Commands;

use App\Resource;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use RecursiveIteratorIterator;
use Symfony\Component\Mime\MimeTypes;

class Dev extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'dev {path} {endpoint?} {token?}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Dev theme.';

    protected string $path;

    protected string $themeId;

    protected int $syncAttempts = 0;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!$this->path = $this->argument('path') or !is_dir($this->path)) {
            $this->error('Theme path is not valid.');
            return;
        }

        if (preg_match('/\/$/', $this->path)) {
            $this->path = preg_replace('/\/$/', '', $this->path);
        }

        if (!$endpoint = $this->argument('endpoint') and !$endpoint = $this->ask('Endpoint')) {
            $this->error('Endpoint is required.');
            return;
        }

        if (!filter_var($endpoint, FILTER_VALIDATE_URL)) {
            $this->error('Invalid endpoint.');
            return;
        }

        if (!$token = $this->argument('token') and !$token = $this->ask('API Token')) {
            $this->error('API Token is required.');
            return;
        }

        $this->info('Connecting...');

        $client = new Client([
            'base_uri' => $endpoint,
            'http_errors' => false,
            'headers' => [
                'api-key' => $token
            ]
        ]);

        // Test connection
        $testResponse = $client->get('api/user');
        if ($testResponse->getStatusCode() !== 200) {
            $this->error('Failed to connect to the API. Please double check the endpoint & token.');
            dump((string) $testResponse->getBody());
            return;
        }
        $this->info('Connected successfully!');

        // List websites
        $this->info('Listing websites...');
        $websitesResponse = $client->get('api/websites?limit=100');
        if ($websitesResponse->getStatusCode() !== 200) {
            $this->error('Failed to list websites.');
            dump((string) $websitesResponse->getBody());
            return;
        }
        $websites = json_decode($websitesResponse->getBody())->data;
        foreach ($websites as $website) {
            $this->line($website->id.': '.$website->name);
        }

        $websiteId = $this->ask('Select website');

        // List themes
        $this->info('Listing themes...');
        $themesResponse = $client->get('api/themes?limit=100');
        if ($themesResponse->getStatusCode() === 404) {
            $this->error('No themes found.');
        } elseif ($themesResponse->getStatusCode() !== 200) {
            $this->error('Failed to get themes.');
        } else {
            $themes = json_decode($themesResponse->getBody())->data;
            foreach ($themes as $theme) {
                $this->line($theme->id.': '.$theme->name);
            }
        }

        // Select theme
        $themeId = (isset($themes) and count($themes)) ? $this->ask('Select theme (leave empty to create new)') : null;
        if (!$themeId) {
            if (!$name = $this->ask('Theme name') or !$key = $this->ask('Theme key')) {
                $this->error('Theme name & key are required.');
            }

            $this->info('Creating new theme...');
            $createThemeResponse = $client->post('api/themes', [
                'json' => [
                    'name' => $name,
                    'key' => $key
                ]
            ]);
            if ($createThemeResponse->getStatusCode() !== 201) {
                $this->error('Failed to create theme.');
                dump((string) $createThemeResponse->getBody());
                return;
            }
            $this->info('Theme created successfully!');

            $themeId = json_decode($createThemeResponse->getBody())->data->id;
        }
        $themeId = trim($themeId);
        $this->themeId = $themeId;

        // Update website theme
        $this->info('Updating website theme...');
        $updateThemeResponse = $client->patch('api/websites/'.$websiteId, [
            'json' => [
                'theme_id' => $themeId
            ]
        ]);
        if ($updateThemeResponse->getStatusCode() !== 200) {
            $this->error('Failed to update website theme.');
            return;
        } else {
            $websiteData = json_decode((string) $updateThemeResponse->getBody())->data;
            if ($websiteData->theme_id !== $themeId) {
                $this->error('Failed to update website theme.');
                return;
            }
        }

        // Set interval
        $interval = $this->ask('Watch interval (in seconds)', 1);

        $this->info('Start watching...');
        while (true) {
            $this->watchAssets($client, $themeId, $this->scanDir($this->path.DIRECTORY_SEPARATOR.'assets'));
            $this->watchViews($client, $themeId, $this->scandir($this->path.DIRECTORY_SEPARATOR.'views'));
            sleep($interval);
        }
    }

    /**
     * @param Client $client
     * @param string $themeId
     * @param RecursiveIteratorIterator $assetFiles
     * @return void
     */
    protected function watchAssets(Client $client, string $themeId, RecursiveIteratorIterator $assetFiles)
    {
        // Get assets from api
        $assetResources = $this->getAllResources($client, 'api/assets', ['filter[theme_id]' => $themeId]);

        // Skip if assets folder not found
        if (!is_dir($this->path.DIRECTORY_SEPARATOR.'assets')) {
            return;
        }

        $assetFiles = $this->scandir($this->path.DIRECTORY_SEPARATOR.'assets');

        // Update assets
        $updatableAssets = $this->spotUpdatedResources('assets', $assetFiles, $assetResources);
        foreach ($updatableAssets as $assetFile) {
            if (!$assetFile instanceof Resource) {
                continue;
            }

            $ext = pathinfo($assetFile->getAbsolutePath())['extension'] ?? '';
            $mime = match (strtolower($ext)) {
                'css' => 'text/css',
                'js' => 'text/javascript',
                'mjs' => 'text/javascript',
                'jsx' => 'text/javascript',
                default => MimeTypes::getDefault()->guessMimeType($assetFile->getAbsolutePath())
            };

            $startTime = microtime(true);
            if ($this->updateResource($client, $assetFile, [
                'mime' => $mime
            ])) {
                $this->line('Asset '.$assetFile->getRelativePath().' is updated successfully. ('.round(microtime(true) - $startTime, 2).'s)');
                $this->syncAttempts = 0;
            } else {
                $this->syncAttempts++;
                if ($this->syncAttempts >= 10) {
                    dd('Too many failed attempts to sync.');
                }
                $this->error('Failed to sync '.$assetFile->getRelativePath());
            }
        }

        // Delete assets
        $deletableAssetResources = $this->spotDeletedResources('assets', $assetFiles, $assetResources);
        foreach ($deletableAssetResources as $assetResource) {
            if (!$assetResource instanceof Resource) {
                continue;
            }

            if ($this->deleteResource($client, $assetResource)) {
                $this->line('Asset '.$assetResource->getRelativePath().' is deleted successfully.');
                $this->syncAttempts = 0;
            } else {
                $this->syncAttempts++;
                if ($this->syncAttempts >= 10) {
                    dd('Too many failed attempts to sync.');
                }
                $this->error('Failed to delete '.$assetResource->getRelativePath());
            }
        }
    }

    /**
     * Watch views
     *
     * @param Client $client
     * @param string $themeId
     * @param RecursiveIteratorIterator $viewFiles
     * @return void
     */
    protected function watchViews(Client $client, string $themeId, RecursiveIteratorIterator $viewFiles)
    {
        // Get views from api
        $viewResources = $this->getAllResources($client, 'api/views', ['filter[theme_id]' => $themeId]);

        // Skip if views folder not found
        if (!is_dir($this->path.DIRECTORY_SEPARATOR.'views')) {
            return;
        }

        $viewFiles = $this->scandir($this->path.DIRECTORY_SEPARATOR.'views');

        // Update views
        $updatableViews = $this->spotUpdatedResources('views', $viewFiles, $viewResources);
        foreach ($updatableViews as $viewFile) {
            if (!$viewFile instanceof Resource) {
                continue;
            }

            $startTime = microtime(true);
            if ($this->updateResource($client, $viewFile)) {
                $this->line('View '.$viewFile->getRelativePath().' is updated successfully. ('.round(microtime(true) - $startTime, 2).'s)');
                $this->syncAttempts = 0;
            } else {
                $this->syncAttempts++;
                if ($this->syncAttempts >= 10) {
                    dd('Too many attempts to sync.');
                }
                $this->error('Failed to sync '.$viewFile->getRelativePath());
            }
        }

        // Delete views
        $deletableViewResources = $this->spotDeletedResources('views', $viewFiles, $viewResources);
        foreach ($deletableViewResources as $viewResource) {
            if (!$viewResource instanceof Resource) {
                continue;
            }

            if ($this->deleteResource($client, $viewResource)) {
                $this->line('View '.$viewResource->getRelativePath().' is deleted successfully.');
                $this->syncAttempts = 0;
            } else {
                $this->syncAttempts++;
                if ($this->syncAttempts >= 10) {
                    dd('Too many attempts to sync.');
                }
                $this->error('Failed to delete '.$viewResource->getRelativePath());
            }
        }
    }

    /**
     * Scan a dir recursively
     *
     * @param string $path
     * @return RecursiveIteratorIterator
     */
    protected function scanDir(string $path): RecursiveIteratorIterator
    {
        return new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
    }

    /**
     * Spot updated files and return a collection of Resource
     *
     * @param string $resourceNamespace
     * @param array $localFiles
     * @param Collection $remoteResources
     * @return Collection
     */
    protected function spotUpdatedResources(string $resourceNamespace, RecursiveIteratorIterator $localFiles, Collection $remoteResources): Collection
    {
        $updatedResources = collect();

        foreach ($localFiles as $file) {
            if ($file->isDir()) {
                continue;
            }

            $absolutePath = $file->getPathname();
            $relativePath = explode($this->path.DIRECTORY_SEPARATOR.$resourceNamespace.DIRECTORY_SEPARATOR, $absolutePath);
            unset($relativePath[0]);
            $relativePath = implode(DIRECTORY_SEPARATOR, $relativePath);

            $content = file_get_contents($absolutePath);
            if (!$content) {
                continue;
            }

            $localFileHash = sha1($content);
            $remoteResource = $remoteResources->where('path', $relativePath)->first();
            if (!$remoteResource or $remoteResource['sha1'] !== $localFileHash) {
                $updatedResources->push(new Resource($resourceNamespace, $relativePath, $absolutePath, $remoteResource ? $remoteResource['id'] : null));
            }
        }

        return $updatedResources;
    }

    /**
     * @param $resourceNamespace
     * @param RecursiveIteratorIterator $localFiles
     * @param Collection $remoteResources
     * @return Collection
     */
    protected function spotDeletedResources(string $resourceNamespace, RecursiveIteratorIterator $localFiles, Collection $remoteResources): Collection
    {
        $deletedResources = collect();

        foreach ($remoteResources as $remoteResource) {
            $relativePath = str_replace('/', DIRECTORY_SEPARATOR, $remoteResource['path']);
            $absolutePath = $this->path.DIRECTORY_SEPARATOR.$resourceNamespace.DIRECTORY_SEPARATOR.$relativePath;

            $isDeleted = true;
            foreach ($localFiles as $localFile) {
                if ($absolutePath === $localFile->getPathName()) {
                    $isDeleted = false;
                    break;
                }
            }

            if ($isDeleted) {
                $deletedResources->push(new Resource($resourceNamespace, $relativePath, $absolutePath, $remoteResource['id']));
            }
        }

        return $deletedResources;
    }

    /**
     * Update resource
     *
     * @param Client $client
     * @param Resource $resource
     * @param array $data
     * @return bool
     */
    protected function updateResource(Client $client, Resource $resource, array $data = []): bool
    {
        $content = base64_encode(file_get_contents($resource->getAbsolutePath()));

        // Update
        if ($id = $resource->getReference()) {
            $updateResponse = $client->patch('api/'.$resource->getResourceNamespace().'/'.$id, [
                'json' => array_merge($data, [
                    'path' => $resource->getRelativePath(),
                    'content' => $content
                ])
            ]);

            return $updateResponse->getStatusCode() === 200;
        }

        // Create
        $createResponse = $client->post('api/'.$resource->getResourceNamespace(), [
            'json' => array_merge($data, [
                'theme_id' => $this->themeId,
                'path' => $resource->getRelativePath(),
                'content' => $content
            ])
        ]);

        if ($createResponse->getStatusCode() !== 201) {
            dump((string) $createResponse->getBody());
            return false;
        }

        return true;
    }

    /**
     * Delete resource
     *
     * @param Resource $resource
     * @return bool
     */
    protected function deleteResource(Client $client, Resource $resource): bool
    {
        if (!$id = $resource->getReference()) {
            return false;
        }

        $deleteResponse = $client->delete('api/'.$resource->getResourceNamespace().'/'.$id);

        if ($deleteResponse->getStatusCode() !== 200) {
            dump((string) $deleteResponse->getBody());
            return false;
        }

        return true;
    }

    /**
     * @param Client $client
     * @param string $uri
     * @return Collection
     */
    protected function getAllResources(Client $client, string $uri, array $query = []): Collection
    {
        $data = [];

        $page = 1;
        $limit = 100;
        while (true) {
            $response = $client->get($uri, [
                'query' => array_merge($query, [
                    'page' => $page,
                    'limit' => $limit
                ])
            ]);

            // Break if request failed
            if ($response->getStatusCode() !== 200) {
                break;
            }

            $resources = json_decode($response->getBody(), true)['data'];
            foreach ($resources as $resource) {
                $data[$resource['id']] = $resource;
            }

            // Break if last page reached
            if (count($resources) < $limit) {
                break;
            }

            // Keep crawling
            $page++;
        }

        return collect($data);
    }
}
