# Các biến được truyền vào:

| Biến            | Loại                                   | Mô tả                                                                                            |
|-----------------|----------------------------------------|--------------------------------------------------------------------------------------------------|
| pageTitle       | string                                 | SEO Title                                                                                        |
| pageDescription | string                                 | SEO Description                                                                                  |
| post            | App\Models\Post                        | Post hiện tại                                                                                    |
| subject         | App\Models\Subject                     | Subject tương ứng với post                                                                       | 
| parts           | Collection<App\Models\Part>            | Các parts của post                                                                               |
| part            | App\Models\Part                        | Part hiện tại                                                                                    |
| content         | App\Models\Content                     | Content tương ứng part hiện tại                                                                  |
| media           | Collection<App\Models\Media>           | Collection của các media tương ứng với part hiện tại                                             |
| websiteTagGroups | Collection<App\Models\WebsiteTagGroup> | Các website tag groups của post, có thể lấy ra các websiteTags từ 1 instance của WebsiteTagGroup |
