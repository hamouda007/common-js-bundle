<?php

namespace Silverback\CommonJsBundle\Model;

class TwigParams
{
    /**
     * @var string
     */
    private $path;
    /**
     * @var array
     */
    private $arguments;
    /**
     * @var string
     */
    private $name;

    public function __construct(
        $path = '',
        $arguments = [],
        string $name = ''
    )
    {
        $this->setPath($path);
        $this->setArguments($arguments);
        $this->setName($name);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path)
    {
        $this->path = $path;
    }

    /**
     * @return array
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }

    /**
     * @param array $arguments
     */
    public function setArguments(array $arguments)
    {
        $this->arguments = $arguments;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }
}
