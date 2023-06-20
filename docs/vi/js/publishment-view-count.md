# Publishment View Counter

- Hàm này sử dụng để đếm view cho publishment.
- Trong `publishment.html` template, tại sự kiện thích hợp, gọi tới hàm này như sau:

```html
<script>
document.addEventListener('DOMContentLoaded', () => window.viewCount('{{ publishment.slug }}'))
</script>
```
