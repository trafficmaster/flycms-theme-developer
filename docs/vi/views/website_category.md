# Các biến được truyền vào:

| Biến              | Loại                       | Mô tả                                     |
|-------------------|----------------------------|-------------------------------------------|
| pageTitle         | string                     | SEO Title                                 |
| pageDescription   | string                     | SEO Description                           |
| websiteCategory   | App\Models\WebsiteCategory | WebsiteCategory tương ứng                 |
| publishments      | Collection\<Publishment>   | List publishments tương ứng (đã paginate) |
| publishmentsCount | int                        | Tổng số publishments matched              |
