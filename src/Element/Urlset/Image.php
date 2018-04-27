<?php declare(strict_types=1);


namespace Sitemaped\Element\Urlset;

use Sitemaped\Element\Element;

/**
 * @link https://support.google.com/webmasters/answer/178636
 */
class Image extends Element
{
    /**
     * @var string
     */
    public $loc;
    /**
     * @var null
     */
    public $caption;
    /**
     * @var null
     */
    public $geo_location;
    /**
     * @var null
     */
    public $title;
    /**
     * @var null
     */
    public $license;

    /**
     * @var string
     */
    protected $name = 'image';
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
        $this->loc = $loc;
        $this->caption = $caption;
        $this->geo_location = $geo_location;
        $this->title = $title;
        $this->license = $license;
    }


    /**
     * @return array
     */
    public function getValue(): array
    {
        $value = [
            new Element('loc', $this->loc, $this->prefix, $this->namespaceUri),
            $this->caption ? new Element('caption', $this->caption, $this->prefix, $this->namespaceUri) : null,
            $this->geo_location ? new Element('geo_location', $this->geo_location, $this->prefix, $this->namespaceUri) : null,
            $this->title ? new Element('title', $this->title, $this->prefix, $this->namespaceUri) : null,
            $this->license ? new Element('license', $this->license, $this->prefix, $this->namespaceUri) : null,
        ];

        return \array_filter($value);
    }
}
