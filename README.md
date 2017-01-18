![meta.php](http://i.hizliresim.com/Wgym6P.png)
# Meta.php

Meta.php ile meta etiketlerini çok basit bir şekilde yönetebilirsiniz.
Bu classı genellikle "header.php", "footer.php", "sidebar.php" vb gibi proje dosyalarınız var ise kullanabilirsiniz. 
# Kurulum
Kurulum için 2 farklı yol deneyebilirsinz. Tavsiyemiz: Github üzerinden indirmenizdir.
#### Composer ile kurulum;
```sh
$ composer require hamzaemre/meta.php
```
#### Direk projeyi indirmek;
https://github.com/hamzaemre/meta.php/archive/master.zip

# Kullanım
PHP bilenler için çok basit kullanımı mevcuttur.
```php
<?php
    // Classımızı dahil ediyoruz.
    require_once 'Meta.php';
    // $meta değişkenine yeni bir sınıf oluşturup atama yapıyoruz.
    $meta = new Meta;
    // Daha sonra $meta->Start(); fonksiyonu ile json dosyamızı okutup içindeki gerekli değerleri alıp işliyoruz. Mesela "title", "meta", "facebook meta", "twitter meta"
    $meta->Start();
```
# metatags.json
```json
{
  "main_path": "/local_folder/",
  "pages": {
    "index.php": {
      "title": "Anasayfa",
      "meta": {
        "keywords": "ana sayfa, web sitesi, bla bla",
        "description": "Ana sayfasının description kısmı..."
      },
      "facebook_meta": {
        "url": "http://www.site.com/index.php",
        "type": "article",
        "title": "Facebook Title",
        "description": "Facebook description...",
        "image": "http://www.site.com/image.jpg"
      },
      "twitter_meta": {
        "card": "summary_large_image",
        "site": "@username",
        "creator": "@username",
        "title": "Twitter Title",
        "description": "Twitter description...",
        "image:src": "http://www.site.com/image.jpg"
      }
    }
  }
}
```
Burada en önemli kısım "main_path" kısmıdır. Eğer script'iniz, local sunucuda yada server'da bir dizin altında çalışıyor ise bunu belirtmelisiniz.

----
# Bana ulaşın:
##### Gmail: hamzaemre0@gmail.com
##### Twitter: https://twitter.com/HamzaEmrel
