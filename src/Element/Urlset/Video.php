<?php declare(strict_types=1);

namespace Sitemaped\Element\Urlset;


use Sitemaped\Element\Element;

/**
 * @link https://developers.google.com/webmasters/videosearch/sitemaps
 */
class Video extends Element
{
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
    protected $name = 'video';
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
            new Element('thumbnail_loc', $this->thumbnail_loc, $this->prefix, $this->getNamespaceUri()),
            new Element('title', $this->title, $this->prefix, $this->getNamespaceUri()),
            new Element('description', $this->description, $this->prefix, $this->getNamespaceUri()),

            $this->content_loc ? new Element('content_loc', $this->content_loc, $this->prefix, $this->getNamespaceUri()) : null,
            $this->player_loc ? new Element('player_loc', $this->player_loc, $this->prefix, $this->getNamespaceUri()) : null,
            $this->duration ? new Element('duration', $this->duration, $this->prefix, $this->getNamespaceUri()) : null,
            $this->expiration_date ? new Element('expiration_date', $this->expiration_date, $this->prefix, $this->getNamespaceUri()) : null,
            $this->rating ? new Element('rating', $this->rating, $this->prefix, $this->getNamespaceUri()) : null,
            $this->view_count ? new Element('view_count', $this->view_count, $this->prefix, $this->getNamespaceUri()) : null,
            $this->publication_date ? new Element('publication_date', $this->publication_date, $this->prefix, $this->getNamespaceUri()) : null,
            $this->family_friendly ? new Element('family_friendly', $this->family_friendly, $this->prefix, $this->getNamespaceUri()) : null,
            $this->tag ? new Element('tag', $this->tag, $this->prefix, $this->getNamespaceUri()) : null,
            $this->category ? new Element('category', $this->category, $this->prefix, $this->getNamespaceUri()) : null,
            $this->restriction ? new Element('restriction', $this->restriction, $this->prefix, $this->getNamespaceUri()) : null,
            $this->gallery_loc ? new Element('gallery_loc', $this->gallery_loc, $this->prefix, $this->getNamespaceUri()) : null,
            $this->price ? new Element('price', $this->price, $this->prefix, $this->getNamespaceUri()) : null,
            $this->requires_subscription ? new Element('requires_subscription', $this->requires_subscription, $this->getNamespaceUri()) : null,
            $this->uploader ? new Element('uploader', $this->uploader, $this->prefix, $this->getNamespaceUri()) : null,
            $this->platform ? new Element('platform', $this->platform, $this->prefix, $this->getNamespaceUri()) : null,
            $this->live ? new Element('live', $this->live, $this->prefix, $this->getNamespaceUri()) : null,
        ];

        return \array_filter($value);
    }
}
