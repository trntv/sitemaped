<?php declare(strict_types = 1);

namespace Sitemaped\Element\Urlset;

use Sitemaped\Element\Element;

class Url extends Element
{
    public const CHANGEFREQ_ALWAYS = 'always';
    public const CHANGEFREQ_HOURLY = 'hourly';
    public const CHANGEFREQ_DAILY = 'daily';
    public const CHANGEFREQ_WEEKLY = 'weekly';
    public const CHANGEFREQ_MONTHLY = 'monthly';
    public const CHANGEFREQ_YEARLY = 'yearly';
    public const CHANGEFREQ_NEVER = 'never';

    /**
     * @var string
     */
    public $loc;
    /**
     * @var null
     */
    public $lastmod;
    /**
     * @var string
     */
    public $changefreq;
    /**
     * @var float
     */
    public $priority;

    /**
     * @var array
     */
    public $images = [];
    /**
     * @var array
     */
    public $videos = [];
    /**
     * @var array
     */
    public $news = [];

    /**
     * @var string
     */
    protected $name = 'url';
    /**
     * @var string
     */
    protected $namespaceUri = 'http://www.sitemaps.org/schemas/sitemap/0.9';

    /**
     * @param string $loc
     * @param string|\DateTime $lastmod
     * @param string|null $changefreq
     * @param float|null $priority
     */
    public function __construct(string $loc, $lastmod = null, string $changefreq = null, float $priority = null)
    {
        $this->loc = $loc;
        $this->lastmod = $lastmod;
        $this->changefreq = $changefreq;
        $this->priority = $priority;
    }

    // up to 1000 images

    /**
     * @param Image $image
     */
    public function addImage(Image $image)
    {
        if (count($this->images) >= 1000) {
            throw new \DomainException('Images limit reached');
        }
        $this->images[] = $image;
    }

    /**
     * @param Video $video
     */
    public function addVideo(Video $video)
    {
        $this->videos[] = $video;
    }

    /**
     * @param News $news
     */
    public function addNews(News $news)
    {
        $this->news[] = $news;
    }

    /**
     * @return array
     */
    public function getValue(): array
    {
        $lastmod = $this->lastmod;
        if ($lastmod !== null && !($lastmod instanceof \DateTime)) {
            $lastmod = new \DateTime($this->lastmod);
        }

        $value = [
            new Element('loc', $this->loc),
            $this->lastmod ? new Element('lastmod', $lastmod->format(\DateTime::W3C)) : null,
            $this->changefreq ? new Element('changefreq', $this->changefreq) : null,
            $this->priority ? new Element('priority', $this->priority) : null
        ];
        return \array_merge(\array_filter($value), $this->images, $this->videos, $this->news);
    }
}
