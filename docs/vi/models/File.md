# File Model
- File thuộc về nhiều CDNs (VD: 1 video có thể có nhiều stream servers), file nằm trên CDN được đại diện bởi model CdnFile

VD:
```twig
<!-- Lấy ra các CDNs mà của file -->
{% set cdns = model_relation(file, 'cdns') %}

{% for cdn in cdns %}

    <!-- Lấy link file theo CDN -->
    <!-- CdnFile là đối tượng quan hệ giữa File và Cdn -->
    {% set cdnFile = model_relation(cdn, 'cdnFile') %}
  
    <!-- Đoạn này hơi phức tạp 1 chút, nhưng để lấy CDN file url thì làm như này -->
    CDN File URL: {{ cdn.getCdnHandle().getCdnFileUrl(cdnFile).getUrl() }}
    
{% endfor %}
```

# Attributes

| Attribute              | Type    | Mô tả                                                                 |
|------------------------|---------|-----------------------------------------------------------------------|
| type | App\Enums\FileType | FileType::IMAGE, FileType::VIDEO, FileType::IFRAME, FileType::UNKNOWN |
| key                    | string  | File path                                                             |
| mime                   | string  | File mime type                                                        |
| size                   | integer | File size in bytes                                                    |
| active_cdn_files_count | integer | Tổng số CdnFile                                                       |
