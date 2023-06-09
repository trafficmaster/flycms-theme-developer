# Các biến được truyền vào:

| Biến            | Loại                               | Mô tả                                   |
|-----------------|------------------------------------|-----------------------------------------|
| pageTitle       | string                             | SEO Title                               |
| pageDescription | string                             | SEO Description                         |
| websiteTagGroup | App\Models\WebsiteTagGroup         | WebsiteTagGroup tương ứng               |
| websiteTags     | Collection\<App\Models\WebsiteTag> | List WebsiteTag tương ứng (đã paginate) |
