<?php

namespace JsSdkBundle\Twig\Extension;

use JsSdkBundle\Provider\BaseProvider;
use JsSdkBundle\Provider\ProviderInterface;
use JsSdkBundle\Renderer\TwigParamsRenderer;
use JsSdkBundle\ServiceProvider\ServiceProvider;

class JsSdkExtension extends \Twig_Extension
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
            new \Twig_SimpleFunction('js_sdk_add_block', array($this, 'addBlock')),
            new \Twig_SimpleFunction('js_sdk_output', array($this, 'output'), [
                'is_safe' => ['html']
            ]),
            new \Twig_SimpleFunction('js_sdk_duplicate', array($this, 'duplicate')),
            new \Twig_SimpleFunction('js_sdk_remove_block', array($this, 'removeBlock'))
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

    public function addBlock(string $sdk, string $block, string $atBlockPath = null, bool $prepend = false, array $args = []): void
    {
        $provider = $this->getProvider($sdk);
        $provider->addScriptBlock($block, $atBlockPath, $prepend, $args);
    }

    /**
     * @param string $sdk
     * @param string $block
     */
    public function removeBlock(string $sdk, string $block): void
    {
        $provider = $this->getProvider($sdk);
        $provider->removeScriptBlock($block);
    }

    public function output(string $sdk, array $twigArgs = [])
    {
        $provider = $this->getProvider($sdk);
        return $provider->renderSdk($twigArgs);
    }

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
}
