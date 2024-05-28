# Post View Counter

- Hàm này sử dụng để đếm view cho post.
- Trong `post.html` template, tại sự kiện thích hợp, gọi tới hàm này như sau:

```html
<script>
document.addEventListener('DOMContentLoaded', () => window.viewCount('{{ post.slug }}'))
</script>
```
