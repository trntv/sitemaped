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
     * @var null
     */
    protected $caption;
    /**
     * @var null
     */
    protected $geo_location;
    /**
     * @var null
     */
    protected $title;
    /**
     * @var null
     */
    protected $license;
    /**
     * @var string
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
    public function __construct(string $loc, string $caption = null, string $geo_location = null, string $title = null, string $license = null)
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
     * @param string $loc
     */
    public function setLoc(string $loc): void
    {
        $this->loc = $loc;
    }

    /**
     * @return null
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * @param null $caption
     */
    public function setCaption($caption): void
    {
        $this->caption = $caption;
    }

    /**
     * @return null
     */
    public function getGeoLocation()
    {
        return $this->geo_location;
    }

    /**
     * @param null $geo_location
     */
    public function setGeoLocation($geo_location): void
    {
        $this->geo_location = $geo_location;
    }

    /**
     * @return null
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param null $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return null
     */
    public function getLicense()
    {
        return $this->license;
    }

    /**
     * @param null $license
     */
    public function setLicense($license): void
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
