# Publishment Model

## Attributes

| Attribute               | Type                 | Mô tả                                                                                                                            |
|-------------------------|----------------------|----------------------------------------------------------------------------------------------------------------------------------|
| visibility              | App\Enums\Visibility | Visibility::PUBLIC, Visibility::PRIVATE                                                                                          |
| restriction             | integer              | 0: Ko bị giới hạn hiển thị, 1: Chỉ hiển thị ở trang category/tag, 2: Không hiển thị ở website, chi có thể vào qua link trực tiếp |
| lang                    | App\Enums\Lang       | Mặc định Lang::DEFAULT                                                                                                           |
| title                   | string               | Title                                                                                                                            |
| slug                    | string               | Slug                                                                                                                             |
| description             | string               | Description                                                                                                                      |
| contents_count          | integer              | Số lượng contents thực tế                                                                                                        |
| expected_contents_count | integer              | Số lượng contents kì vọng                                                                                                        |
| media_count             | integer              | Số lượng media thực tế                                                                                                           |
| expected_media_count    | integer              | Số lượng media kì vọng                                                                                                           |
| sorting                 | integer              | Số thứ tự sắp xếp                                                                                                                |
| views                   | integer              | Lượt xem                                                                                                                         |
## Relations

| Relation          | Type                                   | Mô tả                                              |
|-------------------|----------------------------------------|----------------------------------------------------|
| thumbnailFile     | App\Models\File                        | Ảnh thumbnail                                      |
| subject           | App\Models\Subject                     | Subject                                            |
| contents          | Collection<App\Models\Content>         | Tất cả contents của publishment (tất cả các parts) |
| websiteCategories | Collection<App\Models\WebsiteCategory> | Categories                                         |
| websiteTags       | Collection<App\Models\WebsiteTag>      | Tags                                               |
