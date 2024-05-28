# Các biến được truyền vào:

| Biến             | Loại                      | Mô tả                              |
|------------------|---------------------------|------------------------------------|
| pageTitle        | string                    | SEO Title                          |
| pageDescription  | string                    | SEO Description                    |
| search           | null \| App\Models\Search | Đối tượng Search tương ứng         |
| keywords         | string                    | Từ khoá người dùng search          |
| websiteTags      | Collection\<WebsiteTag\>  | Các website tags matched           |
| websiteTagsCount | int                       | Tổng số lượng website tags matched |
| posts     | Collection\<Post>  | Các posts matched           |
| postsCount | int                       | Tổng số lượng posts matched |

# Lưu ý:

Tham số GET params để truyền keywords vào mặc định sẽ là "keywords", nhưng nên lấy động theo website meta `search-query-name` như sau:

```html
<input type="text" name="{{ website.getMetaValue('search-query-name') ?: 'keywords' }}" placeholder="Search..." />
```
