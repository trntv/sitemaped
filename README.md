# PHP Sitemap abstraction library 
---
```
$sitemap = new Sitemap();
$links = function() {
     foreach(range('a', 'z') as $letter) {
         yield new Url(
             'https://vocabula.ry/'.$letter,
             new \DateTime('2017-01-01 00:00:01'),
             Url::CHANGEFREQ_MONTHLY,
             0.8
         );
     }
 }
$urlset = new Urlset($links);
$sitemap->
```
