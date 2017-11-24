<?php

namespace JsSdkBundle\Twig\Extension;

use JsSdkBundle\Provider\BaseProvider;
use JsSdkBundle\Provider\ProviderInterface;
use JsSdkBundle\Utils\ProviderServiceProvider;

class JsSdkExtension extends \Twig_Extension
{
    /**
     * @var ProviderServiceProvider
     */
    private $providerServiceProvider;

    public function __construct(
        ProviderServiceProvider $providerServiceProvider
    )
    {
        $this->providerServiceProvider = $providerServiceProvider;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('js_sdk_add_block', array($this, 'addBlock'), [
                'needs_environment' => true
            ]),
            new \Twig_SimpleFunction('js_sdk_output', array($this, 'output'), [
                'is_safe' => ['html'],
                'needs_environment' => true
            ]),
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

    public function addBlock(\Twig_Environment $twig, string $sdk, string $block, string $atBlockPath = null, bool $prepend = false, array $args = []): void
    {
        $provider = $this->getProvider($sdk);
        $TwigParams = $provider->getBlockTwigParams($block, $args);
        $scripts = $twig->render($TwigParams->getPath(), $TwigParams->getArguments());
        $provider->addScriptBlock($block, $scripts, $atBlockPath, $prepend);
    }

    public function output(\Twig_Environment $twig, string $sdk)
    {
        $provider = $this->getProvider($sdk);
        $TwigParams = $provider->getOutputTwigParams();
        return $twig->render($TwigParams->getPath(), $TwigParams->getArguments());
    }
}
