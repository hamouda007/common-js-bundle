<?php

namespace Silverback\CommonJsBundle\Provider;

use Silverback\CommonJsBundle\Model\TwigParams;
use Silverback\CommonJsBundle\NameConverter\PascalCaseToSnakeCaseConverter;
use Silverback\CommonJsBundle\NameConverter\ProviderClassNameConverterInterface;
use Silverback\CommonJsBundle\Renderer\TwigParamsRenderer;
use Silverback\CommonJsBundle\Util\NamespaceGetter;
use Symfony\Component\Validator\Exception\InvalidOptionsException;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class BaseProvider implements ProviderInterface
{
    /**
     * @var TwigParamsRenderer
     */
    private $twigParamsRenderer;

    /**
     * @var ValidatorInterface
     */
    private $validator;

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
        TwigParamsRenderer $twigParamsRenderer,
        ValidatorInterface $validator
    )
    {
        $this->twigParamsRenderer = $twigParamsRenderer;
        $this->validator = $validator;
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
        return preg_replace('/Provider$/', '', $class);
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
        return NamespaceGetter::getTwigNamespace() . '/blocks/' . $this->getBlockName() . '/';
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
        foreach($args as $param)
        {
            if(is_object($param) && 0 === strpos(get_class($param), NamespaceGetter::getModelNamespace() . $this->getPascalCaseBlock() . '\\'))
            {
                $errors = $this->validator->validate($param);
                if (count($errors) > 0) {
                    $errorsString = (string) $errors;
                    throw new ValidatorException($errorsString);
                }
            }
        }

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

    public function renderSdk(array $twigArgs = [], bool $noscript = false): string
    {
        $allTwigArgs = array_merge(
            $this->getTwigArgs() ?: [],
            $twigArgs
        );

        if (!$noscript) {
            $scripts = '';
            /**
             * @var TwigParams $twigParams
             */
            foreach ($this->scripts as $twigParams)
            {
                $scripts .= $this->twigParamsRenderer->render($twigParams);
            }

            $allTwigArgs = array_merge(
                $allTwigArgs,
                [
                    'scripts' => $scripts
                ]
            );
        }

        $outputTwigParams = new TwigParams(
            $this->getBlockPath() . ($noscript ? 'html/' : '') . 'init.html.twig',
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
        $fullClass = NamespaceGetter::getModelNamespace() . $this->getPascalCaseBlock() . '\\' . self::getConverter()->denormalize($model);
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
