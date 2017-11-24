<?php

namespace JsSdkBundle\Resources\config;

use JsSdkBundle\Renderer\TwigParamsRenderer;
use JsSdkBundle\Twig\Extension\JsSdkExtension;
use JsSdkBundle\ServiceProvider\ServiceProvider;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return function(ContainerConfigurator $configurator) {
    $services = $configurator->services();

    $services
        ->defaults()
        ->autowire()
        ->autoconfigure()
        ->private()
    ;

    $services
        ->set(ServiceProvider::class)
        ->set(TwigParamsRenderer::class)
        ->set(JsSdkExtension::class)
            ->tag('twig.extension')
        ->load('JsSdkBundle\\Provider\\', '../../Provider/*')
    ;
};
