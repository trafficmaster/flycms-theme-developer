# Template Engine
- Themes sử dụng template engine [Twig 3](https://twig.symfony.com/)
- Mọi features mặc định của Twig đều được support (https://twig.symfony.com/doc/3.x/)

# Cấu trúc theme
- Theme sẽ gồm 2 thư mục:

| Path    | Mô tả                            |
|---------|----------------------------------|
| /assets | Chứa các file js, css, images... |
| /views | Chứa các file template HTML Twig |

- Hướng dẫn chi tiết về từng template có thể xem thêm tại file .md có tên tương ứng.
- Bên trong /views sẽ có các files templates sau.

| Template               | Mô tả              |
|------------------------|--------------------|
| home.html              | Trang chủ          |
| page.html              | Trang page tự do   |
| post.html              | Trang post details |
| search.html            | Trang search       |
| website_category.html  | Trang category     |
| website_tag.html       | Trang tag          |
| website_tag_group.html | Trang tag group    | 
| error.html             | Trang báo lỗi      |

# Global variables
- Dưới dây là danh sách các biến global có thể gọi ra ở mọi templates.

| Tên biến | Loại               | Mô tả                         |
|----------|--------------------|-------------------------------|
| website  | App\Models\Website | Website hiện tại đang request |
| domain   | App\Models\Domain  | Domain tương ứng với request  |
| theme | App\Models\Theme | Theme hiện tại                |

# Extensions
- Danh sách các extensions trong template environment, xem thêm tại `./extensions`

# Common JS & CSS

Chèn `components/common_css.html` vào cuối thẻ <head> để sử dụng các common styles:
```html
{% include 'components/common_css.html' %}
```

Chèn `components/common_js.html` vào cuối thẻ <body> để sử dụng các common functions:
```html
{% include 'components/common_js.html' %}
```

# Lưu ý đặc biệt:
- Trong template, không gọi model relation trực tiếp mà phải gọi qua hàm `model_relation` (Xem thêm: `./docs/model.md`). 

VD:
```twig
<!-- Sai -->
{% set thumbnailFile = post.thumbnailFile %}

<!-- Đúng -->
{% set thumbnailFile = model_relation(post, 'thumbnailFile') %}
```
