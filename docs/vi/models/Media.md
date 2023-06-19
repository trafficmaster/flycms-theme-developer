# Media Model
- Media là đối tượng đại diện cho ảnh (web tin tức, truyện tranh...), video (web phim)...
- Media thuộc về Part
- Media có nhiều File

## Attributes

| Attribute   | Type           | Mô tả                       |
|-------------|----------------|-----------------------------|
| lang        | App\Enums\Lang | Mặc định Lang::DEFAULT      |
| title       | string         | Title                       |
| description | string         | Description                 |
| files_count | integer        | Tổng số files (ảnh, videos) |
