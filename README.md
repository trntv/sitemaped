# PHP Sitemap abstraction library
--- 
1. Add urls one-by-one
    ```php
    $urlset = new Urlset($links);
    
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
             
             $urlset->addUrl($url);
         }
     
    
    $sitemap = new Sitemap($urlset);
    
    $sitemap->toXmlString();
    $sitemap->toTxtString();
    $sitemap->write(__DIR__ . '/sitemap.xml');
    $sitemap->write(__DIR__ . '/sitemap.txt', Sitemap::FORMAT_TXT);
    ```

2. Using links generator
    ```php
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
3. Sitemap index
    ```php
    $index = new Sitemapindex();
    $sitemap = new Sitemap($index);
    
    foreach (range(1, 2) as $i) {
        $sitemap = new SitemapindexSitemap(
            'http://test.com/'.$i,
           '-1 year'
        );
        $index->addSitemap($sitemap);
    }

    $content = $sitemap->toXmlString();
    ```
