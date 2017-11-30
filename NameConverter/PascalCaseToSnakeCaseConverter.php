<?php

namespace Silverback\CommonJsBundle\NameConverter;

use Silverback\CommonJsBundle\Util\NamespaceGetter;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;

class PascalCaseToSnakeCaseConverter extends CamelCaseToSnakeCaseNameConverter implements ProviderClassNameConverterInterface
{
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
        return NamespaceGetter::getProviderNamespace() . $this->denormalize($propertyName) . 'Provider';
    }
}
