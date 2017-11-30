<?php

namespace Silverback\CommonJsBundle\Tests\src\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FacebookSdkController
 * @package Silverback\CommonJsBundle\Tests\src\Controller
 * @author Daniel West <daniel@silverback.is>
 * @Route("/facebook-sdk")
 */
class FacebookSdkController extends AbstractController
{
    /**
     * @Route("")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function basic()
    {
        return $this->render('@Test/facebook_sdk/basic.html.twig');
    }
}
