# EnumExtension
- Cung cấp các hàm liên quan tới xử lý Enum.

## Function `enum_check($value, string $enum): bool`
- So sánh value có trung giá trị với enum không.
- Tham số `string $enum` là tên của Enum class nằm trong `App\Enums`. VD đối với enum `App\Enums\ActionStatus::SUCCESS` thì cách sử dụng là `enum_check($value, 'ActionStatus::SUCCESS')`

## Function `enum_value(BackedEnum $enumValue): mixed`
- Trả về giá trị backed của enum

VD:
```twig
Publishment visibility: {{ enum_value(publishment.visibility) }}
```
