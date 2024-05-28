# Fetch Posts
- Chức năng này để fetch resources thông qua ajax mà không cần phải viết Javascript, chỉ cần thêm thuộc tính vào thẻ html theo cấu trúc quy định trước.
- Tham khảo ví dụ dưới đây

```html
 <div class="video-details__side">

    <div x-data="list('/ajax/suggestions/{{ post.slug }}', true, 10)">
        <div class="posts">
            <template x-for="post in data">
                <p x-text="post.title"></p>
            </template>
        </div>
        <div class="text-center mt-3">
            <div x-show="isLoading" class="text-center">
                ...Loading...
            </div>
            <button x-bind="trigger" class="button">Xem thêm</button>
        </div>
    </div>

</div>
```

# Hàm Alpine.data: list()

Các tham số:

| Param | Description         |
|-------|---------------------|
| endpoint | /ajax/some-endpoint |
| initAutoFetch | Default: true       |
| limit | Default: 20         | 
| max | Default: 500        |

Các data mà hàm này cung cấp:

| Name         | Type    | Description           |
|--------------|---------|-----------------------|
| data         | array   | Array của các resources |
| isLoading    | boolean | Loading state         |
| isEnded      | boolean | Đã hết data hay chưa  |
| errorMessage | string  | Error m               |

Các binding objects:

| Name | Description                         |
|------|-------------------------------------|
| trigger | Nút load more. Bind vào một button. |
