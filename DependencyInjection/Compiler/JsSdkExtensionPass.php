<?php

namespace JsSdkBundle\DependencyInjection\Compiler;

use JsSdkBundle\NameConverter\PascalCaseToSnakeCaseConverter;
use JsSdkBundle\Utils\ProviderServiceProvider;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\Finder\Finder;

class JsSdkExtensionPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $provider = $container->register(ProviderServiceProvider::class);
        $finder = new Finder();
        $finder->files()->in(__DIR__ . '/../../Provider/Sdk')->name('/\.php$/');
        foreach($finder as $file) {
            $class = rtrim($file->getFilename(),'.php');
            $fullClass = PascalCaseToSnakeCaseConverter::PROVIDERS_NS . $class;
            $provider->addMethodCall( 'addProvider', [new Reference($fullClass)] );
        }
    }
}