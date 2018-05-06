<?php declare(strict_types=1);

namespace Sitemaped;

use DomainException;
use Sitemaped\Element\Element;

class Sitemap
{
    public const FORMAT_XML = 'xml';
    public const FORMAT_TXT = 'txt';

    /**
     * @var string
     */
    public $version = '1.0';
    /**
     * @var string
     */
    public $encoding = 'UTF-8';
    /**
     * @var Element
     */
    public $root;
    /**
     * @var int
     */
    public $gzipLevel = -1;
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
    public function __construct(Element $root)
    {
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
     * @return string
     */
    public function toXmlString($gzip = false): string
    {
        $this->document =  new \DOMDocument($this->version, $this->encoding);
        $this->document->formatOutput = true;

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
    public function toTxtString($gzip = false): string
    {
        $str = '';
        foreach ($this->ensureRoot()->getValue() as $url) {
            $str .= $url->loc."\r\n";
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
    public function toString($format = self::FORMAT_XML, $gzip = false): string
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
     * @param $path
     * @param string $format
     * @param bool $gzipped
     * @return int
     */
    public function write($path, $format = self::FORMAT_XML, $gzipped = false): int
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
     * @param Element $element
     * @param \DOMNode|null $parentNode
     * @return null
     */
    protected function appendElements(Element $element, \DOMNode $parentNode = null): void
    {
        $xmlElement = $this->document->createElement($element->getName());
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
        $this->addRootNamespace($this->baseNamespaceUri, $name, $element->getNamespaceUri());

        foreach ($element->getExtraNamespaces() as $name => $uri) {
            $this->addRootNamespace($this->baseNamespaceUri, $name, $uri);
        }

        $value = $element->getValue();
        if (empty($value)) {
            return;
        }

        if (\is_scalar($value)) {
            $xmlElement->nodeValue = $this->normalizeValue($value);
        }

        if ($value instanceof \DateTime) {
            $xmlElement->nodeValue = $value->format(\DateTime::W3C);
        }

        if (\is_iterable($value)) {
            foreach ($value as $v)
            {
                $this->appendElements($v, $xmlElement);
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

    /**
     * @param $value
     * @return string
     */
    private function normalizeValue($value): string
    {
        return \htmlentities((string) $value);
    }
}
