<?php

namespace JsSdkBundle\Model\GoogleAnalytics;

interface EcNameIdInterface
{
    /**
     * @return string|null
     */
    public function getName();

    /**
     * @return string|null
     */
    public function getId();
}