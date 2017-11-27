<?php

namespace JsSdkBundle\Twig\Extension;

use JsSdkBundle\Serializer\Normalizer\ExcludeNullObjectNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Serializer;

class SerializerExtension extends \Twig_Extension
{
    /**
     * @var Serializer
     */
    private $serializer;

    public function __construct()
    {
        $normalizers = array(new DateTimeNormalizer(), new ExcludeNullObjectNormalizer());
        $encoders = array(new JsonEncoder());

        $this->serializer = new Serializer($normalizers, $encoders);
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('serialize_json', array($this, 'serialize')),
            new \Twig_SimpleFunction('deserialize_json', array($this, 'deserialize'))
        ];
    }

    public function serialize($object)
    {
        return $this->serializer->serialize($object, 'json');
    }

    public function deserialize(string $data, string $class)
    {
        return $this->serializer->deserialize($data, $class, 'json');
    }
}
