<?php

namespace Silverback\CommonJsBundle\Resources\config;

use Silverback\CommonJsBundle\Renderer\TwigParamsRenderer;
use Silverback\CommonJsBundle\Twig\Extension\CommonJsExtension;
use Silverback\CommonJsBundle\ServiceProvider\ServiceProvider;
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
        ->load('Silverback\\CommonJsBundle\\Twig\\Extension\\', '../../Twig/Extension/*')
        ->load('Silverback\\CommonJsBundle\\Provider\\', '../../Provider/*')
    ;
};
