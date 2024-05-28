# Các biến được truyền vào:

| Biến            | Loại                      | Mô tả                              |
|-----------------|---------------------------|------------------------------------|
| pageTitle       | string                    | SEO Title                          |
| pageDescription | string                    | SEO Description                    |
| websiteCategory | App\Models\WebsiteCategory | WebsiteCategory tương ứng          |
| posts           | Collection\<Post>         | List posts tương ứng (đã paginate) |
| postsCount      | int                       | Tổng số posts matched              |
