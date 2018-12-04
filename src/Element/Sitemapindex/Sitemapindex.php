<?php declare(strict_types=1);

namespace Sitemaped\Element\Sitemapindex;

use Sitemaped\Element\Element;

class Sitemapindex extends Element
{
    public const NAME = 'sitemapindex';

    /**
     * Sitemapindex constructor.
     * @param iterable $sitemaps
     */
    public function __construct(iterable $sitemaps = [])
    {
        parent::__construct(self::NAME);
        $this->value = $sitemaps;
    }

    /**
     * @param Sitemapnode $sitemap
     */
    public function addSitemap(Sitemapnode $sitemap): void
    {
        if (count($this->value) >= 50000) {
            throw new \DomainException('Urls limit reached');
        }
        $this->value[] = $sitemap;
    }
}
