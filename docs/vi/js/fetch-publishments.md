# Fetch Publishments
- Chức năng này để fetch publishments thông qua ajax mà không cần phải viết Javascript, chỉ cần thêm thuộc tính vào thẻ html theo cấu trúc quy định trước.
- Tham khảo ví dụ dưới đây

```html
<div data-fetch-target="/ajax/suggestions/{{ publishment.slug }}" data-fetch-limit="10" data-auto-fetch="true">
    <div data-fetch-results>
        <div data-fetch-result>
            
            <!-- Thumbnail -->
            <img data-fetch-result-thumbnail="{{ link_asset('images/default.png') - link image default }}" />
            <br />

            <!-- Link & title -->
            <a data-fetch-result-url data-fetch-result-title></a>
            <br />
            
            <!-- Description -->
            <small data-fetch-result-description class="suggestions__suggestion__description"></small>
            <hr />
        </div>
    </div>
    
    <!-- Loader khi đang fetch -->
    <div data-fetch-loader>...Loading...</div>
    
    <!-- Nút fetch more -->
    <button data-fetch-send-request>Fetch more</button>
</div>
```
