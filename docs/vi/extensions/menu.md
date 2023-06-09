# MenuExtension
- Cung cấp các function liên quan tới Menu.

## Function `menu_all(?int $websiteId = null): ?Collection<App\Models\Menu>`
- Trả về Collection của tất cả menu tương ứng với $websiteId (null sẽ lấy theo website hiện tại)

## Function `menu_solve(string $key, ?int $websiteId = null): array`
- Param 1 menu key.
- Param 2 website id, null sẽ lấy website hiện tại.
- Trả về array menu data.
