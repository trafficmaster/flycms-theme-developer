# MultikeyFilterExtension
- Cung cấp các hàm liên quan tới MultikeyFilter (sử dụng để get publishments)

## Function `multikey_filter_publishment_query(bool $paginate = true): App\Contracts\MultikeyFilter\MultikeyFilterQuery`
- Khởi tạo đối tương `MultikeyFilterQuery` đối với `Publishment`
- Có thể sử dụng đối tượng này để build query sau đó từ query get ra kết quả.

Danh sách các methods của `MultikeyFilterQuery`

| Method                                                | Mô tả                                                                                |
|-------------------------------------------------------|--------------------------------------------------------------------------------------|
| setReferences(array $references)                      | Truyền vào các publishment ids                                                       |
| setFilterKeys(array $keys)                            | Truyền vào array các filter keys, VD: ['website_category:{id1}', 'website_tag:{id}'] |
| setFilterKeyMatchingType(string $type)                | all: Phải khớp tất cả các filter keys, hoặc one: chỉ cần khớp ít nhất 1 filter key   |
| where(string $field, string $operation, mixed $value) | VD: where('visibility', '=', 'public')                                               |
| sortBy(string $field)                                 | Xếp kết quả theo field                                                               |
| sortAsc()                                             | Xếp tăng dần                                                                         |
| sortDesc()                                            | Xếp giảm dần                                                                         |
| setLimit(int $limit)                                  | Giới hạn kết quả trả về                                                              |
| setOffset(int $offset)                                | Skip $offset kết quả                                                                 |

VD:
```twig
{% 
    set query = multikey_filter_publishment_query()
        .where('visibility', '=', 'public')
        .setFilterKeys(['website_category:1', 'website_category:2'])
        .setFilterKeyMatchingType('all')
        .sortBy('created_at')
        .sortDesc()
        .setLimit(24)
%}
```

## Function `multikey_filter_get_publishments(MultikeyFilterQuery $query, int $cacheTime = 300): Collection<Publishment>`
- Lấy ra publishments theo query nhận được.

VD:
```twig
{% set publishments = multikey_filter_get_publishments(query) %}

{% for publishment in publishments %}
    {{ publishment.title }}<br />
{% endfor %}
```

## Function `multikey_filter_count(MultikeyFilterQuery $query, int $cacheTime = 300): int`
- Đếm số kết quả của query nhận được.

VD:
```twig
{% set query = multikey_filter_publishment_query().where('visibility', '=', 'public') %}
Tổng số publishments: {{ muiltikey_filter_count(query) }}
```
