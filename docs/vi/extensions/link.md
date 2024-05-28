# LinkExtension
- Cung cấp các hàm generate ra link tới các resources.

## Function `url($path = null, $parameters = [], $secure = null): string`
- Hoạt động tương tự hàm `url()` của Laravel

## Function `link_to(Model $resource): string`
- Có thể truyền vào 1 resource bất kì (WebsiteCategory, WebsiteTagGroup, Post...)
- Trả về url tới resource tương ứng.

## Function `link_search(?string $keywords = null): string`
- Trả về url tới search page

## Function `link_post(Post $post, ?int $partSequence): string`
- Trả về url tới post & part sequence tương ứng.

## Function `link_asset(string $path): string`
- Trả về URL của theme asset. VD: Trong theme có file /assets/sample.js, thì có thể gọi tới URL của file này bằng cách `{{ link_asset('sample.js') }}`

## Function `link_replace_query(array $queryData = [], ?string $url = null, bool $override = false): string`
- Hàm này sửa query param của 1 url.
- Tham số 1: Query param cần thêm/sửa.
- Tham số 2: URL cần sửa (để null sẽ dùng url hiện tại)
- Tham số 3: Chọn true để override (xoá toàn bộ query param đang có), hoặc false để merge.

## Function `link_current(bool $withQuery = true): string`
- Trả về url hiện tại

