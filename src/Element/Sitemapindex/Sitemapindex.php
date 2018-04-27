<?php declare(strict_types=1);

namespace Sitemaped\Element\Sitemapindex;

use Sitemaped\Element\Element;

class Sitemapindex extends Element
{
    /**
     * @var string
     */
    protected $name = 'sitemapindex';
    /**
     * @var string
     */
    protected $namespaceUri = 'http://www.sitemaps.org/schemas/sitemap/0.9';

    /**
     * Sitemapindex constructor.
     * @param iterable $sitemaps
     */
    public function __construct(iterable $sitemaps = [])
    {
        $this->value = $sitemaps;
    }

    /**
     * @param Sitemap $sitemap
     */
    public function addSitemap(Sitemap $sitemap): void
    {
        if (count($this->value) >= 50000) {
            throw new \DomainException('Urls limit reached');
        }
        $this->value[] = $sitemap;
    }
}
