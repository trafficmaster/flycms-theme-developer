<?php

namespace App;

final class Resource
{
    public function __construct(protected string $resourceNamespace, protected string $relativePath, protected ?string $absolutePath = null, protected ?int $reference = null)
    {
        //
    }

    public function getAbsolutePath(): ?string
    {
        return $this->absolutePath ?? null;
    }

    public function getRelativePath(): string
    {
        return $this->relativePath;
    }

    public function getResourceNamespace(): string
    {
        return $this->resourceNamespace;
    }

    public function getReference(): ?int
    {
        return $this->reference ?? null;
    }
}
