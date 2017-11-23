<?php

namespace JsSdkBundle\Tests\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController extends Controller
{
    public function test()
    {
        return $this->render('@JsSdkBundle/base.html.twig');
    }

    public function testEmpty()
    {
        return $this->render('@JsSdkBundleTest/test.html.twig');
    }
}
