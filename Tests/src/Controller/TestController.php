<?php

namespace JsSdkBundle\Tests\src\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/google-analytics")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function googleAnalytics()
    {
        return $this->render('@Test/test_google.html.twig');
    }

    /**
     * @Route("/empty")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function emptyAction()
    {
        return $this->render('@Test/test_empty.html.twig');
    }
}
