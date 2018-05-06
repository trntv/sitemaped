# PHP Sitemap abstraction library [Work in progress]
--- 
```
$links = function() {
     foreach(range('a', 'z') as $letter) {
         $url = new Url(
             'https://vocabula.ry/'.$letter,
             new \DateTime('2017-01-01 00:00:01'),
             Url::CHANGEFREQ_MONTHLY,
             0.8
         );
         
         $url->addImage(new Image('https://test.com/image/'.$i));
         $url->addVideo(new Video('https://test.com/video/'.$i, 'Title '.$i, 'Description '.$i));
         $url->addNews(new News('Awesome news '.$i, '2018-01-01', 'Awesome news name '.$i, 'ru-RU'));
         
         yield $url;
     }
}
 
$urlset = new Urlset($links);
$sitemap = new Sitemap($urlset);

$sitemap->toXmlString();
$sitemap->toTxtString();
$sitemap->write(__DIR__ . '/sitemap.xml');
$sitemap->write(__DIR__ . '/sitemap.txt', Sitemap::FORMAT_TXT);
```
