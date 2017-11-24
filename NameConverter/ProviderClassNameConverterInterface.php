<?php

namespace JsSdkBundle\NameConverter;

use Symfony\Component\Serializer\NameConverter\NameConverterInterface;

interface ProviderClassNameConverterInterface extends NameConverterInterface
{
    public function denormalizeToProviderClassName($block);
}
