<?php

namespace Silverback\CommonJsBundle\Model\GoogleAnalytics;

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