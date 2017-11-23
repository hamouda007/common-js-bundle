<?php

namespace JsSdkBundle\Providers;

interface ProviderInterface
{
    /**
     * @return string
     */
    function getBlockPath(): string;

    /**
     * @return string
     */
    function getBlockName(): string;

    /**
     * @param string $blockPath
     * @param array|null $args
     * @return $this
     */
    function addScriptBlock(string $blockPath, array $args = null);

    /**
     * @param array|null $twigArgs
     * @return mixed
     */
    function getTwigArgs(array $twigArgs = null);
}
