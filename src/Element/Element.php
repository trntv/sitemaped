<?php declare(strict_types=1);

namespace Sitemaped\Element;

class Element
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var mixed
     */
    protected $value;
    /**
     * @var null|string
     */
    protected $namespaceUri = 'http://www.sitemaps.org/schemas/sitemap/0.9';
    /**
     * @var array
     */
    protected $extraNamespaces = [];
    /**
     * @var null|string
     */
    protected $prefix = '';
    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * @param null|string $namespace
     * @param iterable $attributes
     * @param iterable $items
     */
    public function __construct(string $name, $value, ?string $prefix = null, string $namespace = null)
    {
        $this->name = $name;
        $this->value = $value;

        if ($prefix !== null) {
            $this->prefix = $prefix;
        }

        if ($namespace !== null) {
            $this->namespaceUri = $namespace;
        }
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        $name = $this->name;
        if (!empty($this->prefix)) {
            $name = \sprintf('%s:%s', $this->prefix, $this->name);
        }

        return $name;
    }

    /**
     * @return iterable
     */
    public function getAttributes(): iterable
    {
        return $this->attributes;
    }

    /**
     * @return null|string
     */
    public function getNamespaceUri(): ?string
    {
        return $this->namespaceUri;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $name
     * @param string $value
     * @param string $namespace
     */
    public function addAttribute(string $name, string $value, string $namespace = '')
    {
        $this->attributes[$namespace][$name] = $value;
    }

    /**
     * @return string
     */
    public function getPrefix(): string
    {
        return $this->prefix;
    }

    /**
     * @return array
     */
    public function getExtraNamespaces(): array
    {
        return $this->extraNamespaces;
    }
}
