<?php

namespace JsSdkBundle\Model;

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

    public function __construct(
        $path = '',
        $arguments = []
    )
    {
        $this->path = $path;
        $this->arguments = $arguments;
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
}