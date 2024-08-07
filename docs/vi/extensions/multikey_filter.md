# MultikeyFilterExtension
- Cung cấp các hàm liên quan tới MultikeyFilter (sử dụng để get posts)

## Function `multikey_filter_post_query(bool $paginate = true): App\Contracts\MultikeyFilter\MultikeyFilterQuery`
- Khởi tạo đối tương `MultikeyFilterQuery` đối với `Post`
- Có thể sử dụng đối tượng này để build query sau đó từ query get ra kết quả.

Danh sách các methods của `MultikeyFilterQuery`

| Method                                                | Mô tả                                                                                                                                          |
|-------------------------------------------------------|------------------------------------------------------------------------------------------------------------------------------------------------|
| setReferences(array $references)                      | Truyền vào các post ids                                                                                                                        |
| setFilterKeys(array $keys)                            | Truyền vào array các filter keys, VD: ['{website-category-id}', '{website-tag-id}']                                                            |
| setFilterKeyMatchingType(string $type)                | all (default): Phải khớp tất cả các filter keys, hoặc one: chỉ cần khớp ít nhất 1 filter key                                                   |
| setExcludeKeys(array $keys)                           | Truyền vào array các keys sẽ bị loại trừ khỏi kết quả.                                                                                         |
| setExcludeKeyMatchingType(string $type)               | all: Chỉ loại trừ những documents chứa tất cả exclude keys, hoặc one (default): loại trừ những documents chứa ít nhất 1 key trong exclude keys |
| where(string $field, string $operation, mixed $value) | VD: where('visibility', '=', 'public')                                                                                                         |
| sortBy(string $field)                                 | Xếp kết quả theo field                                                                                                                         |
| sortAsc()                                             | Xếp tăng dần                                                                                                                                   |
| sortDesc()                                            | Xếp giảm dần                                                                                                                                   |
| setLimit(int $limit)                                  | Giới hạn kết quả trả về                                                                                                                        |
| setOffset(int $offset)                                | Skip $offset kết quả                                                                                                                           |

VD:
```twig
{% 
    set query = multikey_filter_post_query()
        .where('visibility', '=', 'public')
        .setFilterKeys(['website-category-id-1', 'website-category-id-2'])
        .setFilterKeyMatchingType('all')
        .sortBy('created_at')
        .sortDesc()
        .setLimit(24)
%}
```

## Function `multikey_filter_get_posts(MultikeyFilterQuery $query, int $cacheTime = 300): Collection<Post>`
- Lấy ra posts theo query nhận được.

VD:
```twig
{% set posts = multikey_filter_get_posts(query) %}

{% for post in posts %}
    {{ post.title }}<br />
{% endfor %}
```

## Function `multikey_filter_count(MultikeyFilterQuery $query, int $cacheTime = 300): int`
- Đếm số kết quả của query nhận được.

VD:
```twig
{% set query = multikey_filter_post_query().where('visibility', '=', 'public') %}
Tổng số posts: {{ muiltikey_filter_count(query) }}
```
