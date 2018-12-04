<?php declare(strict_types=1);

namespace Sitemaped;

use DomainException;
use Sitemaped\Element\Element;
use Sitemaped\Element\Urlset\Urlset;

class Sitemap
{
    public const FORMAT_XML = 'xml';
    public const FORMAT_TXT = 'txt';

    /**
     * @var string
     */
    protected $version = '1.0';
    /**
     * @var string
     */
    protected $encoding = 'UTF-8';
    /**
     * @var Element
     */
    protected $root;
    /**
     * @var int
     */
    protected $gzipLevel = -1;
    /**
     * @var string
     */
    protected $baseNamespaceUri = 'http://www.w3.org/2000/xmlns/';
    /**
     * @var \DOMDocument
     */
    private $document;
    /**
     * @var \DOMElement
     */
    private $rootNode;

    /**
     * Sitemap constructor.
     * @param Element $root
     */
    public function __construct(?Element $root = null)
    {
        if ($root === null) {
            $root = new Urlset();
        }
        $this->root = $root;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        $xpath = new \DOMXPath($this->document);
        return $xpath->query('*/loc')->length;
    }

    /**
     * @param bool $gzip
     * @param bool $formatOutput
     *
     * @return string
     * @throws \Exception
     */
    public function toXmlString(bool $gzip = false, bool $formatOutput = false): string
    {
        $this->document =  new \DOMDocument($this->version, $this->encoding);
        $this->document->formatOutput = $formatOutput;

        if ($this->root === null) {
            throw new DomainException('Root must be set');
        }

        $this->appendElements($this->root);

        $data = $this->document->saveXML();

        if ($gzip === true) {
            $this->ensureZlib();
            $data = \gzencode($data, $this->gzipLevel);
        }

        return $data;
    }

    /**
     * @param bool $gzip
     * @return string
     */
    public function toTxtString(bool $gzip = false): string
    {
        $str = '';
        foreach ($this->ensureRoot()->getValue() as $url) {
            $str .= $url->getLoc()."\r\n";
        }

        if ($gzip === true) {
            $this->ensureZlib();

            $str = \gzencode($str, $this->gzipLevel);
        }

        return $str;
    }

    /**
     * @param string $format
     * @param bool $gzip
     * @return string

     */
    public function toString(string $format = self::FORMAT_XML, bool $gzip = false): string
    {
        switch ($format) {
            case self::FORMAT_XML:
                return $this->toXmlString($gzip);
            case self::FORMAT_TXT:
                return $this->toTxtString($gzip);
            default:
                throw new \InvalidArgumentException('Unknown format');

        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toString(self::FORMAT_XML);
    }

    /**
     * @param string $path
     * @param string $format
     * @param bool $gzipped
     * @return int
     */
    public function write(string $path, $format = self::FORMAT_XML, $gzipped = false): int
    {
        $content = $this->toString($format);
        if ($gzipped === true) {
            $this->ensureZlib();
            $content = \gzcompress($content, $this->gzipLevel);
        }
        return \file_put_contents($path, $content);
    }

    /**
     * @param string $format
     * @return int
     */
    public function getSize($format = self::FORMAT_XML): int
    {
        return \strlen($this->toString($format));
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @param string $version
     */
    public function setVersion(string $version): void
    {
        $this->version = $version;
    }

    /**
     * @return string
     */
    public function getEncoding(): string
    {
        return $this->encoding;
    }

    /**
     * @param string $encoding
     */
    public function setEncoding(string $encoding): void
    {
        $this->encoding = $encoding;
    }

    /**
     * @return Element
     */
    public function getRoot(): Element
    {
        return $this->root;
    }

    /**
     * @param Element $root
     */
    public function setRoot(Element $root): void
    {
        $this->root = $root;
    }

    /**
     * @return int
     */
    public function getGzipLevel(): int
    {
        return $this->gzipLevel;
    }

    /**
     * @param int $gzipLevel
     */
    public function setGzipLevel(int $gzipLevel): void
    {
        $this->gzipLevel = $gzipLevel;
    }

    /**
     * @return string
     */
    public function getBaseNamespaceUri(): string
    {
        return $this->baseNamespaceUri;
    }

    /**
     * @param string $baseNamespaceUri
     */
    public function setBaseNamespaceUri(string $baseNamespaceUri): void
    {
        $this->baseNamespaceUri = $baseNamespaceUri;
    }

    /**
     * @param Element $element
     * @param \DOMNode|null $parentNode
     * @return null
     */
    protected function appendElements(Element $element, \DOMNode $parentNode = null): void
    {
        $xmlElement = $this->document->createElement($element->getName());
        foreach ($element->getAttributes() as $attrName => $attrValue) {
            $xmlElement->setAttribute($attrName, $attrValue);
        }

        if ($parentNode === null) {
            $this->document->appendChild($xmlElement);
            $this->rootNode = $xmlElement;
        } else {
            $parentNode->appendChild($xmlElement);
        }

        $name = 'xmlns';
        if ($element->getPrefix()) {
            $name = \sprintf('%s:%s', $name, $element->getPrefix());
        }
        $this->addRootNamespace($this->baseNamespaceUri, $name, $element->getNamespace()->getUri());

        foreach ($element->getExtraNamespaces() as $ns) {
            $this->addRootNamespace($this->baseNamespaceUri, $ns->getName(), $ns->getUri());
        }

        $value = $element->getValue();
        if (empty($value)) {
            return;
        }

        if (\is_scalar($value)) {
            $xmlElement->nodeValue = $value;
        }

        if ($value instanceof \DateTime) {
            $xmlElement->nodeValue = $value->format(\DateTime::W3C);
        }

        if (\is_iterable($value)) {
            foreach ($value as $v)
            {
                if (!is_array($v)) {
                    $v = [$v];
                }
                foreach ($v as $v1) {
                    $this->appendElements($v1, $xmlElement);
                }
            }
        }
    }

    /**
     * @param $baseUri
     * @param $name
     * @param $value
     */
    protected function addRootNamespace($baseUri, $name, $value): void
    {
        $this->rootNode->setAttributeNS($baseUri, $name, $value);
    }

    /**
     * @return Element
     */
    private function ensureRoot(): Element
    {
        if ($this->root === null) {
            throw new DomainException('Root must be set');
        }

        return $this->root;
    }

    /**
     * @return void
     * @throws \Exception
     */
    private function ensureZlib()
    {
        if (!\extension_loaded('zlib')) {
            throw new \Exception('zlib must be loaded');
        }
    }
}
