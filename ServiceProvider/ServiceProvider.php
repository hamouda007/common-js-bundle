<?php

namespace JsSdkBundle\ServiceProvider;

use JsSdkBundle\Provider\ProviderInterface;

class ServiceProvider
{
    private $providers = [];

    public function addProvider(ProviderInterface $provider, string $key = null)
    {
        $this->providers[$key ?: get_class($provider)] = $provider;
    }

    public function getProvider($key)
    {
        return isset($this->providers[$key]) ? $this->providers[$key] : null;
    }
}
