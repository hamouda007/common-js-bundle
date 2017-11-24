<?php

namespace JsSdkBundle\Resources\config;

use JsSdkBundle\Twig\Extension\JsSdkExtension;
use JsSdkBundle\Utils\ProviderServiceProvider;
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
        ->set(ProviderServiceProvider::class)
        ->set(JsSdkExtension::class)
            ->tag('twig.extension')
        ->load('JsSdkBundle\\Provider\\', '../../Provider/*')
    ;
};
