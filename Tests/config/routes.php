<?php

namespace Silverback\CommonJsBundle\Tests\config;

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $configurator)
{
    $configurator->import('src/Controller/', 'annotation');
};
