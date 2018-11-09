<?php

use Sitemaped\Element\Sitemapindex;
use Sitemaped\Sitemap;

class SitemapindexTest extends \PHPUnit\Framework\TestCase
{
    public function testSitemap()
    {
        $index = new Sitemapindex\Sitemapindex();

        foreach (range(1, 2) as $i) {
            $sitemap = new Sitemapindex\Sitemap(
                'http://test.com/'.$i,
               '-1 year'
            );
            $index->addSitemap($sitemap);
        }

        $sitemap = new Sitemap($index);

        $content = $sitemap->toXmlString();

        $this->assertNotEmpty($content);
    }
}
