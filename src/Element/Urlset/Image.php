<?php declare(strict_types=1);


namespace Sitemaped\Element\Urlset;

use Sitemaped\Element\Element;

/**
 * @link https://support.google.com/webmasters/answer/178636
 */
class Image extends Element
{
    public const NAME = 'image';
    /**
     * @var string
     */
    protected $loc;
    /**
     * @var string|null
     */
    protected $caption;
    /**
     * @var string|null
     */
    protected $geo_location;
    /**
     * @var string|null
     */
    protected $title;
    /**
     * @var string|null
     */
    protected $license;
    /**
     * @var string|null
     */
    protected $prefix = 'image';
    /**
     * @var string
     */
    protected $namespaceUri = 'http://www.google.com/schemas/sitemap-image/1.1';

    /**
     * @param string $loc
     * @param string|null $caption
     * @param string|null $geo_location
     * @param string|null $title
     * @param string|null $license
     */
    public function __construct(string $loc, ?string $caption = null, ?string $geo_location = null, ?string $title = null, ?string $license = null)
    {
        parent::__construct(self::NAME);
        $this->loc = $loc;
        $this->caption = $caption;
        $this->geo_location = $geo_location;
        $this->title = $title;
        $this->license = $license;
    }

    /**
     * @return string
     */
    public function getLoc(): string
    {
        return $this->loc;
    }

    /**
     * @return string|null
     */
    public function getCaption(): ?string
    {
        return $this->caption;
    }

    /**
     * @param string|null $caption
     */
    public function setCaption(?string $caption): void
    {
        $this->caption = $caption;
    }

    /**
     * @return string|null
     */
    public function getGeoLocation(): ?string
    {
        return $this->geo_location;
    }

    /**
     * @param string|null $geo_location
     */
    public function setGeoLocation(?string $geo_location): void
    {
        $this->geo_location = $geo_location;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getLicense(): ?string
    {
        return $this->license;
    }

    /**
     * @param string|null $license
     */
    public function setLicense(?string $license): void
    {
        $this->license = $license;
    }

    /**
     * @return array
     */
    public function getValue(): array
    {
        $value = [
            new Element('loc', $this->loc, $this->prefix, $this->getNamespace()),
            $this->caption ? new Element('caption', $this->caption, $this->prefix, $this->getNamespace()) : null,
            $this->geo_location ? new Element('geo_location', $this->geo_location, $this->prefix, $this->getNamespace()) : null,
            $this->title ? new Element('title', $this->title, $this->prefix, $this->getNamespace()) : null,
            $this->license ? new Element('license', $this->license, $this->prefix, $this->getNamespace()) : null,
        ];

        return \array_filter($value);
    }
}
