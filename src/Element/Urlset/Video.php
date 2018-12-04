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
     * @return string
     */
    public function getThumbnailLoc(): string
    {
        return $this->thumbnail_loc;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getContentLoc(): ?string
    {
        return $this->content_loc;
    }

    /**
     * @param string|null $content_loc
     */
    public function setContentLoc(?string $content_loc): void
    {
        $this->content_loc = $content_loc;
    }

    /**
     * @return string
     */
    public function getPlayerLoc(): ?string
    {
        return $this->player_loc;
    }

    /**
     * @param string|null $player_loc
     */
    public function setPlayerLoc(?string $player_loc): void
    {
        $this->player_loc = $player_loc;
    }

    /**
     * @return string
     */
    public function getDuration(): ?string
    {
        return $this->duration;
    }

    /**
     * @param string|null $duration
     */
    public function setDuration(?string $duration): void
    {
        $this->duration = $duration;
    }

    /**
     * @return string
     */
    public function getExpirationDate(): ?string
    {
        return $this->expiration_date;
    }

    /**
     * @param string|null $expiration_date
     */
    public function setExpirationDate(?string $expiration_date): void
    {
        $this->expiration_date = $expiration_date;
    }

    /**
     * @return string
     */
    public function getRating(): ?string
    {
        return $this->rating;
    }

    /**
     * @param string|null $rating
     */
    public function setRating(?string $rating): void
    {
        $this->rating = $rating;
    }

    /**
     * @return int
     */
    public function getViewCount(): ?int
    {
        return $this->view_count;
    }

    /**
     * @param int|null $view_count
     */
    public function setViewCount(?int $view_count): void
    {
        $this->view_count = $view_count;
    }

    /**
     * @return string
     */
    public function getPublicationDate(): ?string
    {
        return $this->publication_date;
    }

    /**
     * @param string|null $publication_date
     */
    public function setPublicationDate(?string $publication_date): void
    {
        $this->publication_date = $publication_date;
    }

    /**
     * @return string
     */
    public function getFamilyFriendly(): ?string
    {
        return $this->family_friendly;
    }

    /**
     * @param string|null $family_friendly
     */
    public function setFamilyFriendly(?string $family_friendly): void
    {
        $this->family_friendly = $family_friendly;
    }

    /**
     * @return string
     */
    public function getTag(): ?string
    {
        return $this->tag;
    }

    /**
     * @param string|null $tag
     */
    public function setTag(?string $tag): void
    {
        $this->tag = $tag;
    }

    /**
     * @return string
     */
    public function getCategory(): ?string
    {
        return $this->category;
    }

    /**
     * @param string|null $category
     */
    public function setCategory(?string $category): void
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getRestriction(): ?string
    {
        return $this->restriction;
    }

    /**
     * @param string|null $restriction
     */
    public function setRestriction(?string $restriction): void
    {
        $this->restriction = $restriction;
    }

    /**
     * @return string
     */
    public function getGalleryLoc(): ?string
    {
        return $this->gallery_loc;
    }

    /**
     * @param string|null $gallery_loc
     */
    public function setGalleryLoc(?string $gallery_loc): void
    {
        $this->gallery_loc = $gallery_loc;
    }

    /**
     * @return string
     */
    public function getPrice(): ?string
    {
        return $this->price;
    }

    /**
     * @param string|null $price
     */
    public function setPrice(?string $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getRequiresSubscription(): ?string
    {
        return $this->requires_subscription;
    }

    /**
     * @param string|null $requires_subscription
     */
    public function setRequiresSubscription(?string $requires_subscription): void
    {
        $this->requires_subscription = $requires_subscription;
    }

    /**
     * @return string
     */
    public function getUploader(): ?string
    {
        return $this->uploader;
    }

    /**
     * @param string|null $uploader
     */
    public function setUploader(?string $uploader): void
    {
        $this->uploader = $uploader;
    }

    /**
     * @return string
     */
    public function getPlatform(): ?string
    {
        return $this->platform;
    }

    /**
     * @param string|null $platform
     */
    public function setPlatform(?string $platform): void
    {
        $this->platform = $platform;
    }

    /**
     * @return string
     */
    public function getLive(): ?string
    {
        return $this->live;
    }

    /**
     * @param string|null $live
     */
    public function setLive(?string $live): void
    {
        $this->live = $live;
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
