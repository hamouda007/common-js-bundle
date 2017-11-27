<?php

namespace JsSdkBundle\Provider;

use JsSdkBundle\Model\TwigParams;
use JsSdkBundle\NameConverter\PascalCaseToSnakeCaseConverter;
use JsSdkBundle\NameConverter\ProviderClassNameConverterInterface;
use JsSdkBundle\Renderer\TwigParamsRenderer;

abstract class BaseProvider implements ProviderInterface
{
    /**
     * @var TwigParamsRenderer
     */
    private $twigParamsRenderer;

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

    public function __construct(
        TwigParamsRenderer $twigParamsRenderer
    )
    {
        $this->twigParamsRenderer = $twigParamsRenderer;
    }

    public function setTwigArgs(array $twigArgs = null)
    {
        $this->twigArgs = $twigArgs;
    }

    public function getTwigArgs()
    {
        return $this->twigArgs;
    }

    public static function getConverter(): ProviderClassNameConverterInterface
    {
        if (!self::$converter) {
            self::setConverter();
        }
        return self::$converter;
    }

    public function getPascalCaseBlock(): string
    {
        $fullClass = get_class($this);
        $classParts = explode('\\', $fullClass);
        $class = array_pop($classParts);
        return rtrim($class, 'Provider');
    }

    /**
     * @return string
     */
    public function getBlockName(): string
    {
        return self::getConverter()->normalize($this->getPascalCaseBlock());
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
            $allTwigArgs,
            $this->getBlockName() . "::" . $blockPath
        );
    }

    /**
     * @param string $blockPath
     * @param string|null $atBlockPath
     * @param bool $prepend
     * @param array $args
     */
    public function addScriptBlock(string $blockPath, string $atBlockPath = null, bool $prepend = false, array $args = [])
    {
        $twigParams = $this->getBlockTwigParams($blockPath, $args);
        if ($atBlockPath === "false") {
            return $this->twigParamsRenderer->render($twigParams);
        }
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
            [$blockPath => $twigParams],
            array_slice($this->scripts, $offset)
        );

        return null;
    }

    public function removeScriptBlock(string $blockPath)
    {
        if (isset($this->scripts[$blockPath])) {
            unset($this->scripts[$blockPath]);
        }
    }

    private static function setConverter()
    {
        self::$converter = new PascalCaseToSnakeCaseConverter();
    }

    public function renderSdk(array $twigArgs = []): string
    {
        $scripts = '';
        /**
         * @var TwigParams $twigParams
         */
        foreach ($this->scripts as $twigParams)
        {
            $scripts .= $this->twigParamsRenderer->render($twigParams);
        }

        $allTwigArgs = array_merge(
            $this->getTwigArgs() ?: [],
            $twigArgs,
            [
                'scripts' => $scripts
            ]
        );

        $outputTwigParams = new TwigParams(
            $this->getBlockPath() . 'init.html.twig',
            $allTwigArgs,
            $this->getBlockName()
        );
        return $this->twigParamsRenderer->render($outputTwigParams);
    }

    public function setScriptBlockTwigArgs(array $twigArgs = [])
    {
        /**
         * @var TwigParams $twigParams
         */
        foreach ($this->scripts as $blockPath=>$twigParams) {
            $twigParams->setArguments(array_merge(
                $twigParams->getArguments(),
                $twigArgs
            ));
        }
    }

    public function getNewModel(string $model, array $args = [])
    {
        $fullClass = 'JsSdkBundle\\Model\\' . $this->getPascalCaseBlock() . '\\' . self::getConverter()->denormalize($model);
        return new $fullClass(...$args);
    }

    public function __clone()
    {
        $clonedScripts = [];
        foreach ($this->scripts as $blockPath=>$twigParams) {
            $clonedScripts[$blockPath] = clone $twigParams;
        }
        $this->scripts = $clonedScripts;
    }
}
