# ModelExtension
- Cung cấp các hàm liên quan tới model.

## Function `model_relation(Model $resource, string $relationName)`
- Sử dụng hàm này để lấy ra relation resource, thay vì gọi trực tiếp.

VD:
```twig
<!-- Không làm như này trong template -->
{{ set subject = publishment.subject }}

<!-- Nên làm như này -->
{{ set subject = model_relation(publishment, 'subject') }}
```
