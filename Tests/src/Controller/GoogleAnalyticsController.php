<?php

namespace CommonJsBundle\Tests\src\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GoogleAnalyticsController
 * @package CommonJsBundle\Tests\src\Controller
 * @author Daniel West <daniel@silverback.is>
 * @Route("/google-analytics")
 */
class GoogleAnalyticsController extends AbstractController
{
    /**
     * @Route("")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function googleAnalytics()
    {
        return $this->render('@Test/google/basic.html.twig');
    }

    /**
     * @Route("/duplicate")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function googleAnalyticsDuplicate()
    {
        return $this->render('@Test/google/duplicate.html.twig');
    }

    /**
     * @Route("/set")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function googleAnalyticsSet()
    {
        return $this->render('@Test/google/set.html.twig');
    }

    /**
     * @Route("/event")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function googleAnalyticsEvent()
    {
        return $this->render('@Test/google/event.html.twig');
    }

    /**
     * @Route("/return-js")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function googleAnalyticsReturnJsFromBlock()
    {
        return $this->render('@Test/google/at_block_false.html.twig');
    }

    /**
     * @Route("/ec")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function googleAnalyticsEc()
    {
        return $this->render('@Test/google/ec.html.twig');
    }

    /**
     * @Route("/ec-invalid")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function googleAnalyticsInvalidEc()
    {
        return $this->render('@Test/google/ec_invalid.html.twig');
    }
}
