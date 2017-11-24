<?php

namespace JsSdkBundle\DependencyInjection;

use JsSdkBundle\Provider\BaseProvider;
use JsSdkBundle\ServiceProvider\ServiceProvider;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\DependencyInjection\Reference;

class JsSdkExtension extends Extension
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
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $converter = BaseProvider::getConverter();
        $provider = $container->getDefinition(ServiceProvider::class);
        foreach ($config as $snakeCaseBlock => $data) {
            if ($data['enabled']) {
                $providerClass = $converter->denormalizeToProviderClassName($snakeCaseBlock);
                $def = $container->getDefinition($providerClass);
                $def->addMethodCall('setTwigArgs', [$data]);
                $provider->addMethodCall('addProvider', [ new Reference($providerClass) ]);
            }
        }
    }
}
