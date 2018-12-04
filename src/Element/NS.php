<?php declare(strict_types = 1);

namespace Sitemaped\Element;

class NS
{
    /**
     * @var string|null
     */
    protected $name;
    /**
     * @var string|null
     */
    protected $uri;

    /**
     * NS constructor.
     *
     * @param string|null $uri
     * @param string|null $name
     */
    public function __construct($uri, $name = null)
    {
        $this->uri = $uri;
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getUri(): ?string
    {
        return $this->uri;
    }
}