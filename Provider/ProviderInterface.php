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
    public function getPascalCaseBlock(): string;

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
     * @param string|null $atBlockPath
     * @param bool $prepend
     * @param array $args
     */
    function addScriptBlock(string $blockPath, string $atBlockPath = null, bool $prepend = false, array $args = []):  ?string;

    /**
     * @param string $blockPath
     */
    function removeScriptBlock(string $blockPath): void;

    /**
     * @param array $twigArgs
     * @return string
     */
    function renderSdk(array $twigArgs = []): string;

    /**
     * @param array $twigArgs
     */
    function setScriptBlockTwigArgs(array $twigArgs = []): void;

    /**
     * @param string $model
     * @param array $args
     * @return mixed
     */
    public function getNewModel(string $model, array $args = []);
}
