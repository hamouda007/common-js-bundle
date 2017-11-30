<?php

namespace CommonJsBundle\DependencyInjection;

use CommonJsBundle\Provider\BaseProvider;
use CommonJsBundle\ServiceProvider\ServiceProvider;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\DependencyInjection\Reference;

class CommonJsExtension extends Extension implements PrependExtensionInterface
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $this->loadServiceConfig($container);
        $this->readConfigs($configs, $container);
    }

    private function loadServiceConfig(ContainerBuilder $container)
    {
        $loader = new PhpFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.php');
    }

    private function readConfigs(array $configs, ContainerBuilder $container)
    {
        $debug = $container->getParameter('kernel.debug');
        $configuration = new Configuration($debug);
        $config = $this->processConfiguration($configuration, $configs);
        $converter = BaseProvider::getConverter();
        $provider = $container->getDefinition(ServiceProvider::class);
        foreach ($config as $snakeCaseBlock => $data) {
            if ($data['enabled']) {
                $providerClass = $converter->denormalizeToProviderClassName($snakeCaseBlock);
                $def = $container->getDefinition($providerClass);
                $blocks = null;
                if (isset($data['default_blocks'])) {
                    $blocks = $data['default_blocks'];
                    unset($data['default_blocks']);
                }
                $def->addMethodCall('setTwigArgs', [$data]);
                if ($blocks) {
                    foreach ($blocks as $blockName => $blockArgs) {
                        $def->addMethodCall('addScriptBlock', [$blockName, null, false, $blockArgs]);
                    }
                }
                $provider->addMethodCall('addProvider', [ new Reference($providerClass) ]);
            }
        }
    }

    public function prepend(ContainerBuilder $container)
    {
        $container->prependExtensionConfig('framework', [
            'validation' => [
                'enable_annotations' => true
            ]
        ]);
    }
}
