<?php declare(strict_types=1);

namespace Sitemaped\Element\Urlset;

use Sitemaped\Element\Element;

class Urlset extends Element
{
    public const NAME = 'urlset';

    /**
     * Urlset constructor.
     * @param iterable $urls
     */
    public function __construct(iterable $urls = [])
    {
        parent::__construct(self::NAME);
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
