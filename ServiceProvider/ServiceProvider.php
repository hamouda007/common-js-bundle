<?php

namespace CommonJsBundle\ServiceProvider;

use CommonJsBundle\Exception\NoProviderException;
use CommonJsBundle\Provider\ProviderInterface;

class ServiceProvider
{
    private $providers = [];

    public function addProvider(ProviderInterface $provider, string $key = null)
    {
        $this->providers[$key ?: get_class($provider)] = $provider;
    }

    public function getProvider($key)
    {
        if (!isset($this->providers[$key])) {
            throw new NoProviderException(sprintf('The provider "%s" does not exist, you should enable it in your config file', $key));
        }
        return $this->providers[$key];
    }
}
