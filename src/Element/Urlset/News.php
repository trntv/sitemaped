<?php declare(strict_types=1);


namespace Sitemaped\Element\Urlset;
use Sitemaped\Element\Element;

/**
 * @link https://support.google.com/news/publisher/answer/74288
 */
class News extends Element
{
    /**
     * @var string
     */
    public $title;
    /**
     * @var
     */
    public $publication_date;

    /**
     * @var string
     */
    public $publication_name;
    /**
     * @var string
     */
    public $publication_language;
    /**
     * @var string
     */
    public $genres;
    /**
     * @var string
     */
    public $keywords;
    /**
     * @var string
     */
    public $stock_tickers;

    /**
     * @var string
     */
    protected $name = 'news';
    /**
     * @var string
     */
    protected $prefix = 'news';
    /**
     * @var string
     */
    protected $namespaceUri = 'http://www.google.com/schemas/sitemap-news/0.9';

    /**
     * @param string $title
     * @param $publication_date
     * @param string|\DateTime $publication_name
     * @param string $publication_language
     * @param string|null $genres
     * @param string|null $keywords
     * @param string|null $stock_tickers
     */
    public function __construct(
        string $title,
        $publication_date,
        string $publication_name,
        string $publication_language,
        string $genres = null,
        string $keywords = null,
        string $stock_tickers = null
    )
    {
        $this->title = $title;
        $this->publication_date = $publication_date;
        $this->publication_name = $publication_name;
        $this->publication_language = $publication_language;
        $this->genres = $genres;
        $this->keywords = $keywords;
        $this->stock_tickers = $stock_tickers;
    }

    /**
     * @return array|mixed
     */
    public function getValue(): array
    {
        $value = [
            new Element('title', $this->title, $this->prefix, $this->getNamespaceUri()),
            new Element('publication', [
                new Element('name', $this->publication_name, $this->prefix, $this->getNamespaceUri()),
                new Element('language', $this->publication_language, $this->prefix, $this->getNamespaceUri()),
            ], $this->prefix, $this->getNamespaceUri()),
            $this->publication_date ? new Element('publication_date', $this->publication_date, $this->prefix, $this->getNamespaceUri()) : null,
            $this->genres ? new Element('genres', $this->genres, $this->prefix, $this->getNamespaceUri()) : null,
            $this->keywords ? new Element('keywords', $this->keywords, $this->prefix, $this->getNamespaceUri()) : null,
            $this->stock_tickers ? new Element('stock_tickers', $this->stock_tickers, $this->prefix, $this->getNamespaceUri()) : null,
        ];

        return \array_filter($value);
    }
}
