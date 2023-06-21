# Pagination Component

Component `components/pagination.html` được định nghĩa sẵn trong hệ thống. Chỉ cần gọi trực tiếp như bên dưới là dùng được:

```html
{% include 'components/pagination.html' %}
```

## Biến

Component pagination nhận các biến sau (tất cả các biến đều là optional):

| Biến                          | Loại    | Mô tả                                                 |
|-------------------------------|---------|-------------------------------------------------------|
| count                         | integer | Tổng số bản ghi                                       |
| numberLinksCount              | integer | Số lượng "number link", mặc định là 5                 |
| firstText                     | string  | Text cho nút first page, mặc định là kí tự mũi tên    |
| previousText                  | string  | Text cho nút previous page, mặc định là kí tự mũi tên |
| nextText                      | string  | Text cho nút next page, mặc định là kí tự mũi tên     |
| lastText                      | string  | Text cho nút last page, mặc định là kí tự mũi tên     |
| wrapperTag                    | string  | Thẻ HTML bọc ở ngoài cùng, mặc định là nav            |
| wrapperClass                  | string  | CSS class cho thẻ wrapper                             |
| paginationTag                 | string  | Thẻ HTML của pagination, mặc định là ul               |
| paginationClass               | string  | CSS class cho thẻ paginationTag                       |
| paginationItemTag             | string  | Thẻ HTML cho pagination item, măc định là li          |
| paginationItemClass           | string  | CSS class cho thẻ PaginationItemTag                   |
| paginationItemActiveClass     | string  | CSS class cho PaginationItemTag đang active           |
| paginationItemLinkClass       | string  | CSS class cho thẻ <a> của PaginationItem              |
| paginationItemLinkActiveClass | string  | CSS class cho thẻ <a> của PaginationItem đang active  |
