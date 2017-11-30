<?php

namespace Silverback\CommonJsBundle\Model\GoogleAnalytics;

use Silverback\CommonJsBundle\Provider\Js\GoogleAnalyticsProvider;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * Class EcPromo
 * @package Silverback\CommonJsBundle\Model\GoogleAnalytics
 */
class EcPromo implements EcNameIdInterface
{
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addConstraint(new Assert\Callback([
                                                         GoogleAnalyticsProvider::class,
                                                         'validateNameOrId'
                                                     ]));
    }

    /** @var string */
    private $id;

    /** @var string */
    private $name;

    /** @var string|null */
    private $creative;

    /** @var string|null */
    private $position;

    public function __construct(
        string $id = null,
        string $name = null,
        string $creative = null,
        string $position = null
    )
    {
        $this->setId($id);
        $this->setName($name);
        $this->setCreative($creative);
        $this->setPosition($position);
    }

    /**
     * @return string|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id = null)
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name = null)
    {
        $this->name = $name;
    }

    /**
     * @return null|string
     */
    public function getCreative()
    {
        return $this->creative;
    }

    /**
     * @param null|string $creative
     */
    public function setCreative($creative)
    {
        $this->creative = $creative;
    }

    /**
     * @return null|string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param null|string $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }
}
