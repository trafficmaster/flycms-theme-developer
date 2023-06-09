# MultikeyFilterExtension
- Cung cấp các hàm liên quan tới MultikeyFilter

## Function `multikey_filter_publishment_query(bool $paginate = true): App\Contracts\MultikeyFilter\MultikeyFilterQuery`
- Khởi tạo đối tương `MultikeyFilterQuery` đối với `Publishment`
- Có thể sử dụng đối tượng này để build query sau đó từ query get ra kết quả.

VD:
```twig
{% set query = multikey_filter_publishment_query().where('attribute', '=', 'value') %}
```

## Function `multikey_filter_get_publishments(MultikeyFilterQuery $query, int $cacheTime = 300): Collection<Publishment>`
- Lấy ra publishments theo query nhận được.

## Function `multikey_filter_count(MultikeyFilterQuery $query, int $cacheTime = 300): int`
- Đếm số kết quả của query nhận được.
