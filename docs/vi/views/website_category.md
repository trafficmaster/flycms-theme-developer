# Các biến được truyền vào:

| Biến            | Loại                      | Mô tả                               |
|-----------------|---------------------------|-------------------------------------|
| pageTitle       | string                    | SEO Title                           |
| pageDescription | string                    | SEO Description                     |
| websiteCategory | App\Models\WebsiteCategory | WebsiteCategory tương ứng           |
| posts           | Collection\<Post>         | List posts tương ứng (đã paginate)  |
| postsCount      | int                       | Tổng số posts matched               |
| listData | ListData | Xem thêm: standard-data/ListData.md |

# Post filter query params:

| Get query param                       | Value  | Description                                                                                                                                                       |
|---------------------------------------|--------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| attribute_{attribute-name}_{operator} | string | Lọc posts theo attributes. VD: ?attribte_year_gt=2000 (tìm post có attribute year > 2000). Các giá trị có thể có của operator: gt (>), gte (>=), lt (<), lte (<=) |
| categories / tags                     | string | Lọc posts theo categories/tags. VD: ?categories=category-slug-1,category-slug-2&tags=tag-slug-1,tag-slug-2                                                        |
