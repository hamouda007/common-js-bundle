<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'twig.controller.preview_error' shared service.

require_once $this->targetDirs[5].'/vendor/symfony/twig-bundle/Controller/PreviewErrorController.php';

return $this->services['twig.controller.preview_error'] = new \Symfony\Bundle\TwigBundle\Controller\PreviewErrorController(($this->services['http_kernel'] ?? $this->getHttpKernelService()), 'twig.controller.exception:showAction');