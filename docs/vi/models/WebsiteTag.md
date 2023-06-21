# WebsiteTag Model

## Attributes

| Attribute                 | Type                 | Mô tả                     |
|---------------------------|----------------------|---------------------------|
| name                      | string               | Tag name                  |
| slug                      | string               | Slug                      |
| seo_title                 | string               | SEO title                 |
| seo_description           | string               | SEO description           |
| content                   | string               | Content (HTML)            |
| public_publishments_count | integer              | Public publishments count |
| sorting                   | integer              | Sorting                   |

## Relations

| Relation        | Type                       | Mô tả           |
|-----------------|----------------------------|-----------------|
| thumbnailFile   | App\Models\File            | Ảnh thumbnail   |
| websiteTagGroup | App\Models\WebsiteTagGroup | WebsiteTagGroup |
