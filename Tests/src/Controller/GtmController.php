<?php

namespace Silverback\CommonJsBundle\Tests\src\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GtmController
 * @package Silverback\CommonJsBundle\Tests\src\Controller
 * @author Daniel West <daniel@silverback.is>
 * @Route("/gtm")
 */
class GtmController extends AbstractController
{
    /**
     * @Route("")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function basic()
    {
        return $this->render('@Test/gtm/basic.html.twig');
    }
}
