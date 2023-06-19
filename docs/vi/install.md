# Hướng dẫn cài đặt

1. Chạy `composer install`
2. Clone sample theme vào thư mục ./dev để test

- `cp -r ./sample-theme ./dev` 

- Hoặc có thể tạo theme mới để test theo cấu trúc như sau

```
./dev
    ./sample-theme
        ./assets
            ./sample.css
        ./views
            ./home.html
```
3. Chạy lệnh `php theme dev {theme path}`

VD nếu muốn chạy thử sample theme (như bước 2), thì gõ lệnh `php theme dev ./dev/sample-theme`

Follow các bước của command

- Nhập endpoint
- Nhập user api token (xem trong admin)
- Chọn website sẽ dev
- Chọn theme để dev (có thể tạo mới)
