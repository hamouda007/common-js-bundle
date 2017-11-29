<?php

namespace CommonJsBundle\Model\GoogleAnalytics;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class EcProduct
 * @package CommonJsBundle\Model\GoogleAnalytics
 * @Assert\Callback({"CommonJsBundle\Provider\Js\GoogleAnalyticsProvider", "validateNameOrId"})
 */
class EcProduct implements EcNameIdInterface
{
    /** @var string|null */
    private $id;

    /** @var string|null */
    private $name;

    /** @var string|null */
    private $brand;

    /** @var string|null */
    private $category;

    /** @var string|null */
    private $variant;

    /** @var float|null */
    private $price;

    /** @var integer|null */
    private $quantity;

    /** @var string|null*/
    private $coupon;

    /** @var integer|null */
    private $position;

    /**
     * EcProduct constructor.
     * @param string $id
     * @param string $name
     * @param null|string $brand
     * @param null|string $category
     * @param null|string $variant
     * @param float|null $price
     * @param int|null $quantity
     * @param null|string $coupon
     * @param int|null $position
     */
    public function __construct(
        string $id = null,
        string $name = null,
        string $brand = null,
        string $category = null,
        string $variant = null,
        float $price = null,
        int $quantity = null,
        string $coupon = null,
        int $position = null)
    {
        $this->setId($id);
        $this->setName($name);
        $this->setBrand($brand);
        $this->setCategory($category);
        $this->setVariant($variant);
        $this->setPrice($price);
        $this->setQuantity($quantity);
        $this->setCoupon($coupon);
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

    /**
     * @return int|null
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int|null $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return null|string
     */
    public function getCoupon()
    {
        return $this->coupon;
    }

    /**
     * @param null|string $coupon
     */
    public function setCoupon($coupon)
    {
        $this->coupon = $coupon;
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
}
