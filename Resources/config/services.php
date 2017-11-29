<?php

namespace CommonJsBundle\Resources\config;

use CommonJsBundle\Renderer\TwigParamsRenderer;
use CommonJsBundle\Twig\Extension\CommonJsExtension;
use CommonJsBundle\ServiceProvider\ServiceProvider;
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
        ->load('CommonJsBundle\\Twig\\Extension\\', '../../Twig/Extension/*')
        ->load('CommonJsBundle\\Provider\\', '../../Provider/*')
    ;
};
