<?php

namespace JsSdkBundle\Providers;

use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\NameConverter\NameConverterInterface;

abstract class BaseProvider implements ProviderInterface
{
    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @var NameConverterInterface
     */
    private $converter;

    /**
     * @var string
     */
    private $scripts = '';

    /**
     * @var array|null
     */
    private $twigArgs;

    /**
     * BaseProvider constructor.
     * @param \Twig_Environment $twig
     */
    public function __construct(
        \Twig_Environment $twig
    )
    {
        $this->twig = $twig;
        $this->converter = new CamelCaseToSnakeCaseNameConverter();
    }

    /**
     * @return string
     */
    public function getBlockName(): string
    {
        return $this->converter->denormalize(rtrim(get_class($this), 'Provider'));
    }

    /**
     * @return string
     */
    public function getBlockPath(): string
    {
        return '@JsSdkBundle/blocks/' . $this->getBlockName() . '/';
    }

    /**
     * @param string $blockPath
     * @param array|null $args
     * @return $this
     */
    public function addScriptBlock(string $blockPath, array $args = null)
    {
        $this->scripts .= $this->twig->render($this->getBlockPath() . $blockPath, $args);

        return $this;
    }

    public function renderSdk()
    {
        return $this->twig->render($this->getBlockPath() . 'init.html.twig', array_merge($this->getTwigArgs() ?: [], [
            'scripts' => $this->scripts
        ]));
    }
}