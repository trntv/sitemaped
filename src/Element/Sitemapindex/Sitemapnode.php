<?php declare(strict_types=1);

namespace Sitemaped\Element\Sitemapindex;

use Sitemaped\Element\Element;

class Sitemapnode extends Element
{
    public const NAME = 'sitemap';

    /**
     * @var string
     */
    protected $loc;
    /**
     * @var string|\DateTime|null
     */
    protected $lastmod;
    /**
     * Sitemap constructor.
     * @param $loc
     * @param $lastmod
     */
    public function __construct(string $loc, $lastmod = null)
    {
        parent::__construct(self::NAME);
        $this->loc = $loc;
        $this->lastmod = $lastmod;
    }

    /**
     * @return string
     */
    public function getLoc(): string
    {
        return $this->loc;
    }

    /**
     * @param string $loc
     */
    public function setLoc(string $loc): void
    {
        $this->loc = $loc;
    }

    /**
     * @return \DateTime|string
     */
    public function getLastmod()
    {
        return $this->lastmod;
    }

    /**
     * @param \DateTime|string|null $lastmod
     */
    public function setLastmod($lastmod): void
    {
        $this->lastmod = $lastmod;
    }

    /**
     * @return mixed[]
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
