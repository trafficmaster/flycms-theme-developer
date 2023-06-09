# Các biến được truyền vào:

| Biến             | Loại                      | Mô tả                              |
|------------------|---------------------------|------------------------------------|
| pageTitle        | string                    | SEO Title                          |
| pageDescription  | string                    | SEO Description                    |
| search           | null \| App\Models\Search | Đối tượng Search tương ứng         |
| keywords         | string                    | Từ khoá người dùng search          |
| websiteTags      | Collection\<WebsiteTag\>  | Các website tags matched           |
| websiteTagsCount | int                       | Tổng số lượng website tags matched |
| publishments     | Collection\<Publishment>  | Các publishments matched           |
| publishmentsCount | int                       | Tổng số lượng publishments matched |
