<?php


use Sitemaped\Element\Urlset\Image;
use Sitemaped\Element\Urlset\News;
use Sitemaped\Element\Urlset\Url;
use Sitemaped\Element\Urlset\Urlset;
use Sitemaped\Element\Urlset\Video;
use Sitemaped\Sitemap;

class UrlsetTest extends \PHPUnit\Framework\TestCase
{
    public function testUrlset()
    {
        $urlset = new Urlset();
        foreach (range(1, 2) as $i) {
            $url = new Url(
                'https://test.com/'.$i,
                new \DateTime(),
                Url::CHANGEFREQ_MONTHLY,
                1
            );

            $url->addImage(new Image('https://test.com/image/'.$i));
            $url->addVideo(new Video('https://test.com/video/'.$i, 'Title '.$i, 'Description '.$i));
            $url->addNews(new News('Awesome news '.$i, '2018-01-01', 'Awesome news name '.$i, 'ru-RU'));

            $urlset->addUrl($url);
        }

        $sitemap = new Sitemap();
        $sitemap->root = $urlset;

        $content = $sitemap->toXmlString();
        $this->assertNotEmpty($content);
        $this->assertContains('urlset', $content);
        $this->assertContains('video:video', $content);

        $content = $sitemap->toTxtString();
        $this->assertNotEmpty($content);
        $this->assertContains('https://test.com/1', $content);
        $this->assertNotContains('https://test.com/image/1', $content);
    }

}
