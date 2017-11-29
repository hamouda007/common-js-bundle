<?php

namespace CommonJsBundle\Tests\src\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TwitterController
 * @package CommonJsBundle\Tests\src\Controller
 * @author Daniel West <daniel@silverback.is>
 * @Route("/twitter")
 */
class TwitterController extends AbstractController
{
    /**
     * @Route("")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function basic()
    {
        return $this->render('@Test/twitter/basic.html.twig');
    }
}
