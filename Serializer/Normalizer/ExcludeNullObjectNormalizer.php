<?php

namespace CommonJsBundle\Serializer\Normalizer;

use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class ExcludeNullObjectNormalizer extends ObjectNormalizer
{
    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $data = parent::normalize($object, $format, $context);

        return array_filter($data, function ($value) {
            return null !== $value;
        });
    }
}
