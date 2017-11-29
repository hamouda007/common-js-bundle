<?php

namespace CommonJsBundle\Tests\src\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EmptyController extends AbstractController
{
    /**
     * @Route("/empty")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function emptyAction()
    {
        return $this->render('@Test/test_empty.html.twig');
    }
}
