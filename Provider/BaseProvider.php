<?php

namespace JsSdkBundle\Provider;

use JsSdkBundle\Model\TwigParams;
use JsSdkBundle\NameConverter\PascalCaseToSnakeCaseConverter;
use JsSdkBundle\NameConverter\ProviderClassNameConverterInterface;

abstract class BaseProvider implements ProviderInterface
{
    /**
     * @var PascalCaseToSnakeCaseConverter
     */
    protected static $converter;

    /**
     * @var array
     */
    protected $scripts = [];

    /**
     * @var array|null
     */
    protected $twigArgs;

    public function setTwigArgs(array $twigArgs = null): void
    {
        $this->twigArgs = $twigArgs;
    }

    public function getTwigArgs(): ?array
    {
        return $this->twigArgs;
    }

    public static function getConverter(): ProviderClassNameConverterInterface
    {
        if (!self::$converter)
        {
            self::setConverter();
        }
        return self::$converter;
    }

    /**
     * @return string
     */
    public function getBlockName(): string
    {
        $fullClass = get_class($this);
        $classParts = explode('\\', $fullClass);
        $class = array_pop($classParts);
        return self::getConverter()->normalize(rtrim($class, 'Provider'));
    }

    /**
     * @return string
     */
    public function getBlockPath(): string
    {
        return '@JsSdk/blocks/' . $this->getBlockName() . '/';
    }

    public function getBlockTwigParams(string $blockPath, array $args = []): TwigParams
    {
        $allTwigArgs = array_merge(
            $this->getTwigArgs() ?: [],
            $args
        );

        return new TwigParams(
            $this->getBlockPath() . 'js/' . $blockPath . '.js.twig',
            $allTwigArgs
        );
    }

    public function getOutputTwigParams(): TwigParams
    {
        $allTwigArgs = array_merge(
            $this->getTwigArgs() ?: [],
            [
                'scripts' => join('', $this->scripts)
            ]
        );

        return new TwigParams(
            $this->getBlockPath() . 'init.html.twig',
            $allTwigArgs
        );
    }

    /**
     * @param string $blockPath
     * @param array|null $args
     * @param string|null $atBlockPath
     * @param bool $prepend
     */
    public function addScriptBlock(string $blockPath, string $block, string $atBlockPath = null, bool $prepend = false): void
    {
        $offset = $prepend ? 0 : count($this->scripts);
        if ($atBlockPath) {
            $blockOffset = array_search($atBlockPath, array_keys($this->scripts));
            if ($blockOffset !== false) {
                if ($prepend) {
                    $blockOffset--;
                }
                $offset = $blockOffset;
            }
        }

        $this->scripts = array_merge(
            array_slice($this->scripts, 0, $offset),
            [$blockPath => $block],
            array_slice($this->scripts, $offset)
        );
    }

    private static function setConverter()
    {
        self::$converter = new PascalCaseToSnakeCaseConverter();
    }
}