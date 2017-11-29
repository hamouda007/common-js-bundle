<?php

namespace CommonJsBundle\Twig\Extension;

use CommonJsBundle\Provider\BaseProvider;
use CommonJsBundle\Provider\ProviderInterface;
use CommonJsBundle\Renderer\TwigParamsRenderer;
use CommonJsBundle\ServiceProvider\ServiceProvider;

class CommonJsExtension extends \Twig_Extension
{
    /**
     * @var ServiceProvider
     */
    private $providerServiceProvider;

    public function __construct(
        ServiceProvider $providerServiceProvider,
        TwigParamsRenderer $twigParamsRenderer,
        \Twig_Environment $environment
    )
    {
        $this->providerServiceProvider = $providerServiceProvider;
        $twigParamsRenderer::setTwigEnvironment($environment);
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('cjs_add_block', array($this, 'addBlock'), [
                'is_safe' => ['html']
            ]),
            new \Twig_SimpleFunction('cjs_js', array($this, 'outputJs'), [
                'is_safe' => ['html']
            ]),
            new \Twig_SimpleFunction('cjs_html', array($this, 'outputNoscript'), [
                'is_safe' => ['html']
            ]),
            new \Twig_SimpleFunction('cjs_duplicate', array($this, 'duplicate')),
            new \Twig_SimpleFunction('cjs_remove_block', array($this, 'removeBlock')),
            new \Twig_SimpleFunction('cjs_model', array($this, 'newModel'))
        ];
    }

    /**
     * @param string $sdk
     * @return ProviderInterface
     */
    private function getProvider(string $sdk)
    {
        $providerClassName = BaseProvider::getConverter()->denormalizeToProviderClassName($sdk);
        return $this->providerServiceProvider->getProvider($providerClassName);
    }

    /**
     * @param string $sdk
     * @param string $block
     * @param string|null $atBlockPath
     * @param bool $prepend
     * @param array $args
     * @return null|string
     */
    public function addBlock(string $sdk, string $block, string $atBlockPath = null, bool $prepend = false, array $args = [])
    {
        $provider = $this->getProvider($sdk);
        return $provider->addScriptBlock($block, $atBlockPath, $prepend, $args);
    }

    /**
     * @param string $sdk
     * @param string $block
     */
    public function removeBlock(string $sdk, string $block)
    {
        $provider = $this->getProvider($sdk);
        $provider->removeScriptBlock($block);
    }

    /**
     * @param string $sdk
     * @param array $twigArgs
     * @return string
     */
    public function outputJs(string $sdk, array $twigArgs = [])
    {
        return $this->output($sdk, $twigArgs);
    }

    /**
     * @param string $sdk
     * @param array $twigArgs
     * @return string
     */
    public function outputNoscript(string $sdk, array $twigArgs = [])
    {
        return $this->output($sdk, $twigArgs, true);
    }

    /**
     * @param string $sdk
     * @param array $twigArgs
     * @param bool $noscript
     * @return string
     */
    private function output(string $sdk, array $twigArgs = [], bool $noscript = false)
    {
        $provider = $this->getProvider($sdk);
        return $provider->renderSdk($twigArgs, $noscript);
    }

    /**
     * @param string $sdk
     * @param string $newSdkName
     * @param array $twigArgs
     */
    public function duplicate(string $sdk, string $newSdkName, array $twigArgs = [])
    {
        $provider = $this->getProvider($sdk);
        $newProvider = clone $provider;

        $newProvider->setTwigArgs(array_merge(
            $newProvider->getTwigArgs(),
            $twigArgs
        ));
        $newProvider->setScriptBlockTwigArgs($twigArgs);

        $providerClassName = BaseProvider::getConverter()->denormalizeToProviderClassName($newSdkName);
        $this->providerServiceProvider->addProvider($newProvider, $providerClassName);
    }

    /**
     * @param string $sdk
     * @param string $model
     * @param array $args
     * @return mixed
     */
    public function newModel(string $sdk, string $model, array $args = [])
    {
        $provider = $this->getProvider($sdk);
        return $provider->getNewModel($model, $args);
    }
}
