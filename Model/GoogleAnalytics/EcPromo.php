<?php

namespace JsSdkBundle\Model\GoogleAnalytics;

class EcPromo
{
    /** @var string */
    private $id;

    /** @var string */
    private $name;

    /** @var string|null */
    private $creative;

    /** @var string|null */
    private $position;

    public function __construct(
        $id = '',
        $name = '',
        $creative = null,
        $position = null
    )
    {
        $this->setId($id);
        $this->setName($name);
        $this->setCreative($creative);
        $this->setPosition($position);
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
