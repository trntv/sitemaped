<?php declare(strict_types=1);

namespace Sitemaped;

use DomainException;
use Sitemaped\Element\Element;

class Sitemap
{
    public const FORMAT_XML = 'xml';
    public const FORMAT_TXT = 'txt';

    public $version = '1.0';
    public $encoding = 'UTF-8';

    protected $baseNamespaceUri = 'http://www.w3.org/2000/xmlns/';

    /** @var Element */
    public $root;

    /** @var \DOMDocument */
    private $document;
    /** @var \DOMElement */
    private $rootNode;

    /**
     * @return string
     */
    public function toXmlString(): string
    {
        $this->document =  new \DOMDocument($this->version, $this->encoding);
        $this->document->formatOutput = true;

        if ($this->root === null) {
            throw new DomainException('Root must be set');
        }

        $this->appendElements($this->root);

        return $this->document->saveXML();
    }

    /**
     * @return string
     */
    public function toTxtString(): string
    {
        $str = '';
        foreach ($this->ensureRoot()->getValue() as $url) {
            $str .= $url->loc."\r\n";
        }

        return $str;
    }

    /**
     * @param string $format
     * @return string
     */
    private function toString($format = self::FORMAT_XML): string
    {
        switch ($format) {
            case self::FORMAT_XML:
                return $this->toXmlString();
            case self::FORMAT_TXT:
                return $this->toTxtString();
            default:
                throw new \InvalidArgumentException('Unknown format');

        }
    }

    /**
     * @param $path
     * @param string $format
     * @param bool $gzipped
     * @return int
     * @throws \Exception
     */
    public function write($path, $format = self::FORMAT_XML, $gzipped = false): int
    {
        $content = $this->toString($format);
        if ($gzipped === true) {
            if (!\extension_loaded('zlib')) {
                throw new \Exception('zlib must be loaded to compress sitemap');
            }

            $content = \gzcompress($content);
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
     * @param $value
     * @return string
     */
    private function normalizeValue($value): string
    {
        return \htmlentities((string) $value);
    }
}
