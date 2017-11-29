<?php

namespace CommonJsBundle\Model\GoogleAnalytics;

class Event
{
    /** @var  string */
    private $category;

    /** @var  string */
    private $action;

    /** @var  string|null */
    private $label;

    /** @var string|null */
    private $transport;

    /** @var boolean */
    private $nonInteraction;

    public function __construct(
        string $category = '',
        string $action = '',
        string $label = null,
        string $transport = null,
        bool $nonInteraction = false
    )
    {
        $this->setCategory($category);
        $this->setAction($action);
        $this->setLabel($label);
        $this->setTransport($transport);
        $this->setNonInteraction($nonInteraction);
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory(string $category)
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param string $action
     */
    public function setAction(string $action)
    {
        $this->action = $action;
    }

    /**
     * @return null|string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param null|string $label
     */
    public function setLabel(string $label = null)
    {
        $this->label = $label;
    }

    /**
     * @return null|string
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * @param null|string $transport
     */
    public function setTransport(string $transport = null)
    {
        $this->transport = $transport;
    }

    /**
     * @return bool
     */
    public function isNonInteraction(): bool
    {
        return $this->nonInteraction;
    }

    /**
     * @param bool $nonInteraction
     */
    public function setNonInteraction(bool $nonInteraction)
    {
        $this->nonInteraction = $nonInteraction;
    }
}