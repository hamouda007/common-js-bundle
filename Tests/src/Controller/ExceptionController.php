<?php

namespace CommonJsBundle\Tests\src\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TwitterController
 * @package CommonJsBundle\Tests\src\Controller
 * @author Daniel West <daniel@silverback.is>
 * @Route("/exception")
 */
class ExceptionController extends AbstractController
{
    /**
     * @Route("/no-name")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function noName()
    {
        return $this->render('@Test/exception/no_name.html.twig');
    }

    /**
     * @Route("/no-param")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function noParam()
    {
        return $this->render('@Test/exception/no_param.html.twig');
    }
}
