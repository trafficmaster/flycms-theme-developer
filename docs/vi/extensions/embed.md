# EmbedExtension
- Cung cấp các hàm liên quan tới embed code (mã nhúng tự do vào trong template)

## Function `embed_all(?int $websiteId = null, ?string $themeKey = null): Illuminate\Support\Collection<App\Models\Embed>`
- Trả về 1 collection của `App\Models\Embed`
- Nếu truyền vào `$websiteId` hoặc `$themeKey` là null thì sẽ trả về data của webste/theme hiện tại.

## Function `embed_render(string $key, ?int $websiteId = null, ?string $themeKey = null): ?string`
- Trả về code của embed có key tương ứng.

