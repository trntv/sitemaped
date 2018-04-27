<?php declare(strict_types=1);

namespace Sitemaped\Element\Sitemapindex;

use Sitemaped\Element\Element;

class Sitemap extends Element
{
    /**
     * @var string
     */
    public $loc;
    /**
     * @var string|\DateTime
     */
    public $lastmod;

    /**
     * @var string
     */
    protected $name = 'sitemap';
    /**
     * @var string
     */
    protected $namespaceUri = 'http://www.sitemaps.org/schemas/sitemap/0.9';

    /**
     * Sitemap constructor.
     * @param $loc
     * @param $lastmod
     */
    public function __construct(string $loc, $lastmod = null)
    {
        $this->loc = $loc;
        $this->lastmod = $lastmod;
    }

    /**
     * @return array
     */
    public function getValue(): array
    {
        $lastmod = $this->lastmod;
        if ($lastmod && !($lastmod instanceof \DateTime)) {
            $lastmod = new \DateTime($this->lastmod);
        }

        $value = [
            new Element('loc', $this->loc),
            $lastmod ? new Element('lastmod', $lastmod->format(\DateTime::W3C)) : null
        ];

        return \array_filter($value);
    }
}
