<?php

namespace Silverback\CommonJsBundle\Provider;

use Silverback\CommonJsBundle\Model\TwigParams;
use Silverback\CommonJsBundle\NameConverter\ProviderClassNameConverterInterface;

interface ProviderInterface
{
    /**
     * @param array|null $twigAgs
     */
    function setTwigArgs(array $twigAgs = null);

    /**
     * @return array|null
     */
    function getTwigArgs();

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
    function addScriptBlock(string $blockPath, string $atBlockPath = null, bool $prepend = false, array $args = []);

    /**
     * @param string $blockPath
     */
    function removeScriptBlock(string $blockPath);

    /**
     * @param array $twigArgs
     * @param bool $noscript
     * @return string
     */
    function renderSdk(array $twigArgs = [], bool $noscript = false): string;

    /**
     * @param array $twigArgs
     */
    function setScriptBlockTwigArgs(array $twigArgs = []);

    /**
     * @param string $model
     * @param array $args
     * @return mixed
     */
    public function getNewModel(string $model, array $args = []);
}
