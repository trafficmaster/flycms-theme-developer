# Website Model

## Attributes

| Attribute | Type | Mô tả   |
|------------|--------|------|
| status     | string | active / inactive   |
| name       | string | Website name (chỉ sử dụng cho admin phân biệt), để hiện tên website ở ngoài hãy dùng website.getMetaValue('site-name') |

## Traits

### HasMeta

List meta keys:

- site-name
- search-query-name
