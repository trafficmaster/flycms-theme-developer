# ImageExtension
- Cung cấp càng hàm liên quan tới ảnh.

## Function `image_url(File|string|null $file): string`
- Nhận instance của `App\Models\File` hoặc string là file key.
- Trả về url của ảnh

## Function `image_resize(int $width, File|string|null $file): string`
- Tham số 1: Width cần resize
- Tham số 2: Instance của File hoặc string là file key.
- Trả về url của ảnh đã đc resize

