<?php

namespace CommonJsBundle\Model;

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
    private $sdk;

    public function __construct(
        $path = '',
        $arguments = [],
        string $sdk = ''
    )
    {
        $this->setPath($path);
        $this->setArguments($arguments);
        $this->setSdk($sdk);
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
    public function getSdk(): string
    {
        return $this->sdk;
    }

    /**
     * @param string $sdk
     */
    public function setSdk(string $sdk)
    {
        $this->sdk = $sdk;
    }
}
