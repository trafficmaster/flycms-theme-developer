# Các biến được truyền vào:

| Biến            | Loại                         | Mô tả                                                |
|-----------------|------------------------------|------------------------------------------------------|
| pageTitle       | string                       | SEO Title                                            |
| pageDescription | string                       | SEO Description                                      |
| publishment     | App\Models\Publishment       | Publishment hiện tại                                 |
| subject         | App\Models\Subject           | Subject tương ứng với publishment                    | 
| parts           | Collection<App\Models\Part>  | Các parts của publishment                            |
| part            | App\Models\Part              | Part hiện tại                                        |
| content         | App\Models\Content           | Content tương ứng part hiện tại                      |
| media | Collection<App\Models\Media> | Collection của các media tương ứng với part hiện tại |
