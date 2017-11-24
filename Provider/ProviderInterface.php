<?php

namespace JsSdkBundle\Provider;

use JsSdkBundle\Model\TwigParams;
use JsSdkBundle\NameConverter\ProviderClassNameConverterInterface;

interface ProviderInterface
{
    /**
     * @param array|null $twigAgs
     */
    function setTwigArgs(array $twigAgs = null): void;

    /**
     * @return array|null
     */
    function getTwigArgs(): ?array;

    /**
     * @return ProviderClassNameConverterInterface
     */
    static function getConverter(): ProviderClassNameConverterInterface;

    /**
     * @return string
     */
    function getBlockName(): string;

    /**
     * @return string
     */
    function getBlockPath(): string;

    /**
     * @param string $blockPath
     * @param array $args
     * @return TwigParams
     */
    function getBlockTwigParams(string $blockPath, array $args): TwigParams;

    /**
     * @param string $blockPath
     * @param string $block
     * @param string|null $atBlockPath
     * @param bool $prepend
     */
    function addScriptBlock(string $blockPath, string $block, string $atBlockPath = null, bool $prepend = false): void;

    /**
     * @return TwigParams
     */
    function getOutputTwigParams(): TwigParams;
}
