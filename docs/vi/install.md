# Hướng dẫn cài đặt

1. Chạy `composer install`
2. Tạo folder theme test

Cấu trúc theme cần có 2 thư mục `assets` (chứa file images, js, css, fonts...) và `views` (chứa file templates)

```
./sample-theme
    ./assets
        ./sample.css
    ./views
        ./home.html
```
3. 
4. Chạy lệnh `php theme dev {theme path}`

VD: `php theme dev ../sample-theme`

Follow các bước của command

- Nhập endpoint
- Nhập user api token (xem trong admin)
- Chọn website sẽ dev
- Chọn theme để dev (có thể tạo mới)
