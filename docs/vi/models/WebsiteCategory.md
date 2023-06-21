# WebsiteCategory Model

## Attributes

| Attribute                 | Type                 | Mô tả                                  |
|---------------------------|----------------------|----------------------------------------|
| visibility                | App\Enums\Visibility | Visibility::PUBLIC, Visibiliy::PRIVATE |
| title                     | string               | Title                                  |
| slug                      | string               | Slug                                   |
| seo_title                 | string               | SEO title                              |
| seo_description           | string               | SEO description                        |
| content                   | string               | Content (HTML)                         |
| public_publishments_count | integer              | Public publishments count              |
| sorting                   | integer              | Sorting                                |

## Relations

| Relation          | Type                                   | Mô tả                                              |
|-------------------|----------------------------------------|----------------------------------------------------|
| thumbnailFile     | App\Models\File                        | Ảnh thumbnail                                      |
