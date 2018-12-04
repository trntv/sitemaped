<?php declare(strict_types=1);


namespace Sitemaped\Element\Urlset;
use Sitemaped\Element\Element;

/**
 * @link https://support.google.com/news/publisher/answer/74288
 */
class News extends Element
{
    public const NAME = 'news';
    /**
     * @var string
     */
    protected $title;
    /**
     * @var
     */
    protected $publication_date;
    /**
     * @var string
     */
    protected $publication_name;
    /**
     * @var string
     */
    protected $publication_language;
    /**
     * @var string|null
     */
    protected $genres;
    /**
     * @var string|null
     */
    protected $keywords;
    /**
     * @var string|null
     */
    protected $stock_tickers;
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
        parent::__construct(self::NAME);
        $this->title = $title;
        $this->publication_date = $publication_date;
        $this->publication_name = $publication_name;
        $this->publication_language = $publication_language;
        $this->genres = $genres;
        $this->keywords = $keywords;
        $this->stock_tickers = $stock_tickers;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getPublicationDate()
    {
        return $this->publication_date;
    }

    /**
     * @return string
     */
    public function getPublicationName(): string
    {
        return $this->publication_name;
    }

    /**
     * @return string
     */
    public function getPublicationLanguage(): string
    {
        return $this->publication_language;
    }

    /**
     * @return string|null
     */
    public function getGenres(): ?string
    {
        return $this->genres;
    }

    /**
     * @param string|null $genres
     */
    public function setGenres(?string $genres): void
    {
        $this->genres = $genres;
    }

    /**
     * @return string|null
     */
    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    /**
     * @param string|null $keywords
     */
    public function setKeywords(?string $keywords): void
    {
        $this->keywords = $keywords;
    }

    /**
     * @return string|null
     */
    public function getStockTickers(): ?string
    {
        return $this->stock_tickers;
    }

    /**
     * @param string|null $stock_tickers
     */
    public function setStockTickers(?string $stock_tickers): void
    {
        $this->stock_tickers = $stock_tickers;
    }

    /**
     * @return array|mixed
     */
    public function getValue(): array
    {
        $value = [
            new Element('title', $this->title, $this->prefix, $this->getNamespace()),
            new Element('publication', [
                new Element('name', $this->publication_name, $this->prefix, $this->getNamespace()),
                new Element('language', $this->publication_language, $this->prefix, $this->getNamespace()),
            ], $this->prefix, $this->getNamespace()),
            $this->publication_date ? new Element('publication_date', $this->publication_date, $this->prefix, $this->getNamespace()) : null,
            $this->genres ? new Element('genres', $this->genres, $this->prefix, $this->getNamespace()) : null,
            $this->keywords ? new Element('keywords', $this->keywords, $this->prefix, $this->getNamespace()) : null,
            $this->stock_tickers ? new Element('stock_tickers', $this->stock_tickers, $this->prefix, $this->getNamespace()) : null,
        ];

        return \array_filter($value);
    }
}
