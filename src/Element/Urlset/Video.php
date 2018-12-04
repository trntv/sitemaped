<?php declare(strict_types=1);

namespace Sitemaped\Element\Urlset;


use Sitemaped\Element\Element;

/**
 * @link https://developers.google.com/webmasters/videosearch/sitemaps
 */
class Video extends Element
{
    public const NAME = 'video';
    /**
     * @var string
     */
    public $thumbnail_loc;
    /**
     * @var string
     */
    public $title;
    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $content_loc;
    /**
     * @var string
     */
    public $player_loc;
    /**
     * @var string
     */
    public $duration;
    /**
     * @var string
     */
    public $expiration_date;
    /**
     * @var string
     */
    public $rating;
    /**
     * @var int
     */
    public $view_count;
    /**
     * @var string
     */
    public $publication_date;
    /**
     * @var string
     */
    public $family_friendly;
    /**
     * @var string
     */
    public $tag;
    /**
     * @var string
     */
    public $category;
    /**
     * @var string
     */
    public $restriction;
    /**
     * @var string
     */
    public $gallery_loc;
    /**
     * @var string
     */
    public $price;
    /**
     * @var string
     */
    public $requires_subscription;
    /**
     * @var string
     */
    public $uploader;
    /**
     * @var string
     */
    public $platform;
    /**
     * @var string
     */
    public $live;
    /**
     * @var string
     */
    protected $prefix = 'video';
    /**
     * @var string
     */
    protected $namespaceUri = 'http://www.google.com/schemas/sitemap-video/1.1';

    /**
     * @param $thumbnail_loc
     * @param $title
     * @param $description
     */
    public function __construct(string $thumbnail_loc, string $title, string $description)
    {
        parent::__construct(self::NAME);
        $this->thumbnail_loc = $thumbnail_loc;
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * @return array
     */
    public function getValue(): array
    {
        $value = [
            new Element('thumbnail_loc', $this->thumbnail_loc, $this->prefix, $this->getNamespace()),
            new Element('title', $this->title, $this->prefix, $this->getNamespace()),
            new Element('description', $this->description, $this->prefix, $this->getNamespace()),

            $this->content_loc ? new Element('content_loc', $this->content_loc, $this->prefix, $this->getNamespace()) : null,
            $this->player_loc ? new Element('player_loc', $this->player_loc, $this->prefix, $this->getNamespace()) : null,
            $this->duration ? new Element('duration', $this->duration, $this->prefix, $this->getNamespace()) : null,
            $this->expiration_date ? new Element('expiration_date', $this->expiration_date, $this->prefix, $this->getNamespace()) : null,
            $this->rating ? new Element('rating', $this->rating, $this->prefix, $this->getNamespace()) : null,
            $this->view_count ? new Element('view_count', $this->view_count, $this->prefix, $this->getNamespace()) : null,
            $this->publication_date ? new Element('publication_date', $this->publication_date, $this->prefix, $this->getNamespace()) : null,
            $this->family_friendly ? new Element('family_friendly', $this->family_friendly, $this->prefix, $this->getNamespace()) : null,
            $this->tag ? new Element('tag', $this->tag, $this->prefix, $this->getNamespace()) : null,
            $this->category ? new Element('category', $this->category, $this->prefix, $this->getNamespace()) : null,
            $this->restriction ? new Element('restriction', $this->restriction, $this->prefix, $this->getNamespace()) : null,
            $this->gallery_loc ? new Element('gallery_loc', $this->gallery_loc, $this->prefix, $this->getNamespace()) : null,
            $this->price ? new Element('price', $this->price, $this->prefix, $this->getNamespace()) : null,
            $this->requires_subscription ? new Element('requires_subscription', $this->requires_subscription, $this->getNamespace()) : null,
            $this->uploader ? new Element('uploader', $this->uploader, $this->prefix, $this->getNamespace()) : null,
            $this->platform ? new Element('platform', $this->platform, $this->prefix, $this->getNamespace()) : null,
            $this->live ? new Element('live', $this->live, $this->prefix, $this->getNamespace()) : null,
        ];

        return \array_filter($value);
    }
}
