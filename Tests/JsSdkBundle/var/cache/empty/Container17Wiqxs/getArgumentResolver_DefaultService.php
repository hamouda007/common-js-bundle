<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'argument_resolver.default' shared service.

require_once $this->targetDirs[5].'/vendor/symfony/http-kernel/Controller/ArgumentValueResolverInterface.php';
require_once $this->targetDirs[5].'/vendor/symfony/http-kernel/Controller/ArgumentResolver/DefaultValueResolver.php';

return $this->privates['argument_resolver.default'] = new \Symfony\Component\HttpKernel\Controller\ArgumentResolver\DefaultValueResolver();
