<?php

namespace Silverback\CommonJsBundle\Model\GoogleAnalytics;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class EcImpression
 * @package Silverback\CommonJsBundle\Model\GoogleAnalytics
 * @Assert\Callback({"Silverback\CommonJsBundle\Provider\Js\GoogleAnalyticsProvider", "validateNameOrId"})
 */
class EcImpression implements EcNameIdInterface
{
    /** @var string|null */
    private $id;

    /** @var string|null */
    private $name;

    /** @var string|null */
    private $list;

    /** @var string|null */
    private $brand;

    /** @var string|null */
    private $category;

    /** @var string|null */
    private $variant;

    /** @var integer|null */
    private $position;

    /** @var float|null */
    private $price;

    /**
     * EcImpression constructor.
     * @param string $id
     * @param string $name
     * @param null|string $list
     * @param null|string $brand
     * @param null|string $category
     * @param null|string $variant
     * @param int|null $position
     * @param float|null $price
     */
    public function __construct(
        string $id = null,
        string $name = null,
        string $list = null,
        string $brand = null,
        string $category = null,
        string $variant = null,
        int $position = null,
        float $price = null
    )
    {
        $this->setId($id);
        $this->setName($name);
        $this->setList($list);
        $this->setBrand($brand);
        $this->setCategory($category);
        $this->setVariant($variant);
        $this->setPosition($position);
        $this->setPrice($price);
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
    public function getList()
    {
        return $this->list;
    }

    /**
     * @param null|string $list
     */
    public function setList($list)
    {
        $this->list = $list;
    }

    /**
     * @return null|string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param null|string $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    /**
     * @return null|string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param null|string $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return null|string
     */
    public function getVariant()
    {
        return $this->variant;
    }

    /**
     * @param null|string $variant
     */
    public function setVariant($variant)
    {
        $this->variant = $variant;
    }

    /**
     * @return int|null
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int|null $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return float|null
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float|null $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }
}
