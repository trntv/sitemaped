<?php declare(strict_types=1);

namespace Sitemaped\Element\Urlset;

use Sitemaped\Element\Element;

class Urlset extends Element
{
    /**
     * @var string
     */
    protected $name = 'urlset';
    /**
     * @var string
     */
    protected $namespaceUri = 'http://www.sitemaps.org/schemas/sitemap/0.9';

    /**
     * Urlset constructor.
     * @param iterable $urls
     */
    public function __construct(iterable $urls = [])
    {
        $this->value = $urls;
    }

    /**
     * @param Url $url
     */
    public function addUrl(Url $url): void
    {
        if (count($this->value) >= 50000) {
            throw new \DomainException('Urls limit reached');
        }
        $this->value[] = $url;
    }
}
