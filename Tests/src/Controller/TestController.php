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
        return $this->render('@Test/google/basic.html.twig');
    }

    /**
     * @Route("/google-analytics/duplicate")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function googleAnalyticsDuplicate()
    {
        return $this->render('@Test/google/duplicate.html.twig');
    }

    /**
     * @Route("/google-analytics/set")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function googleAnalyticsSet()
    {
        return $this->render('@Test/google/set.html.twig');
    }

    /**
     * @Route("/google-analytics/event")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function googleAnalyticsEvent()
    {
        return $this->render('@Test/google/event.html.twig');
    }

    /**
     * @Route("/google-analytics/return-js")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function googleAnalyticsReturnJsFromBlock()
    {
        return $this->render('@Test/google/at_block_false.html.twig');
    }

    /**
     * @Route("/google-analytics/ec")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function googleAnalyticsEc()
    {
        return $this->render('@Test/google/ec.html.twig');
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
