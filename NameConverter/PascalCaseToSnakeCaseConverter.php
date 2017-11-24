<?php

namespace JsSdkBundle\NameConverter;

use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;

class PascalCaseToSnakeCaseConverter extends CamelCaseToSnakeCaseNameConverter implements ProviderClassNameConverterInterface
{
    const PROVIDERS_NS = 'JsSdkBundle\Provider\Sdk\\';

    public function normalize($propertyName)
    {
        return parent::normalize(lcfirst($propertyName));
    }

    public function denormalize($propertyName)
    {
        return ucfirst(parent::denormalize($propertyName));
    }

    public function denormalizeToProviderClassName($propertyName)
    {
        return self::PROVIDERS_NS . $this->denormalize($propertyName) . 'Provider';
    }
}
