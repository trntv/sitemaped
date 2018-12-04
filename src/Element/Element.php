<?php declare(strict_types=1);

namespace Sitemaped\Element;

class Element
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var mixed|null
     */
    protected $value;
    /**
     * @var NS[]
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
     * @var Element[]
     */
    protected $children = [];
    /**
     * @var NS
     */
    protected $namespace;
    /**
     * @var null|string
     */
    protected $namespaceName;
    /**
     * @var null|string
     */
    protected $namespaceUri = 'http://www.sitemaps.org/schemas/sitemap/0.9';

    /**
     * Element constructor.
     *
     * @param string      $name
     * @param             $value
     * @param string|null $prefix
     * @param NS|null     $namespace
     * @param array       $attributes
     */
    public function __construct(string $name, $value = null, ?string $prefix = null, ?NS $namespace = null, array $attributes = [])
    {
        $this->name = $name;
        $this->value = $value;
        $this->prefix = $prefix ?: $this->prefix;
        $this->namespace = $namespace ?: new NS($this->namespaceUri);
        $this->attributes = $attributes;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        $name = $this->name;
        if ($this->prefix !== null && $this->prefix !== '') {
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
     * @return NS
     */
    public function getNamespace(): NS
    {
        return $this->namespace;
    }

    /**
     * @param NS $namespace
     */
    public function setNamespace(NS $namespace): void
    {
        $this->namespace = $namespace;
    }

    /**
     * @return NS[]
     */
    public function getExtraNamespaces(): array
    {
        $childrenNamespaces = [];
        foreach ($this->children as $child) {
            $rns = $child->getNamespace();
            $childrenNamespaces[$rns->getName()] = $rns;
            foreach ($child->getExtraNamespaces() as $ns) {
                $childrenNamespaces[$ns->getName()] = $ns;
            }
        }

        return array_unique(array_merge($this->extraNamespaces, $childrenNamespaces));
    }

    /**
     * @return Element[]
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * @param Element $children
     */
    public function addChild(Element $children): void
    {
        $this->children[] = $children;
    }
}
