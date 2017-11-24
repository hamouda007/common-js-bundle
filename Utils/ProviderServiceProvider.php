<?php

namespace JsSdkBundle\Utils;

use JsSdkBundle\Provider\ProviderInterface;

class ProviderServiceProvider
{
    private $providers = [];

    public function addProvider(ProviderInterface $provider)
    {
        $this->providers[get_class($provider)] = $provider;
    }

    public function getProvider($fullClassName)
    {
        return isset($this->providers[$fullClassName]) ? $this->providers[$fullClassName] : null;
    }
}
