<?php

namespace CommonJsBundle\Model\GoogleAnalytics;

use Symfony\Component\Validator\Constraints as Assert;

class EcAction
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Callback({"CommonJsBundle\Provider\Js\GoogleAnalyticsProvider", "validateEcAction"})
     */
    private $name;

    /** @var string|null */
    private $affiliation;

    /** @var float|null */
    private $revenue;

    /** @var float|null */
    private $tax;

    /** @var float|null */
    private $shipping;

    /** @var string|null */
    private $coupon;

    /** @var string|null */
    private $list;

    /** @var integer|null */
    private $step;

    /** @var string|null */
    private $option;

    /**
     * EcAction constructor.
     * @param string $name
     * @param string $id
     * @param null|string $affiliation
     * @param float|null $revenue
     * @param float|null $tax
     * @param float|null $shipping
     * @param null|string $coupon
     * @param null|string $list
     * @param int|null $step
     * @param null|string $option
     */
    public function __construct(
        string $name,
        string $id,
        string $affiliation = null,
        float $revenue = null,
        float $tax = null,
        float $shipping = null,
        string $coupon = null,
        string $list = null,
        int $step = null,
        string $option = null)
    {
        $this->setName($name);
        $this->setId($id);
        $this->setAffiliation($affiliation);
        $this->setRevenue($revenue);
        $this->setTax($tax);
        $this->setShipping($shipping);
        $this->setCoupon($coupon);
        $this->setList($list);
        $this->setStep($step);
        $this->setOption($option);
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return null|string
     */
    public function getAffiliation()
    {
        return $this->affiliation;
    }

    /**
     * @param null|string $affiliation
     */
    public function setAffiliation($affiliation)
    {
        $this->affiliation = $affiliation;
    }

    /**
     * @return float|null
     */
    public function getRevenue()
    {
        return $this->revenue;
    }

    /**
     * @param float|null $revenue
     */
    public function setRevenue($revenue)
    {
        $this->revenue = $revenue;
    }

    /**
     * @return float|null
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * @param float|null $tax
     */
    public function setTax($tax)
    {
        $this->tax = $tax;
    }

    /**
     * @return float|null
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * @param float|null $shipping
     */
    public function setShipping($shipping)
    {
        $this->shipping = $shipping;
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
     * @return int|null
     */
    public function getStep()
    {
        return $this->step;
    }

    /**
     * @param int|null $step
     */
    public function setStep($step)
    {
        $this->step = $step;
    }

    /**
     * @return null|string
     */
    public function getOption()
    {
        return $this->option;
    }

    /**
     * @param null|string $option
     */
    public function setOption($option)
    {
        $this->option = $option;
    }
}
