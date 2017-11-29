<?php

namespace CommonJsBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GtmControllerTest extends WebTestCase
{
    use ControllerTestTrait;

    public function testGtm()
    {
        $client = $this->getClient();
        $this->assertUri($client, '/gtm');

        $this->assertResponseContains($client, [
            "The GTM script does not contain the valid initialisation parameters" => "(window,document,'script','dataLayer','GTM-12345678'); ",
            "The default GTM window dataLayer variable could not be found." => "window.dataLayer = [];",
            "The expected HTML output cannot be found" => "<iframe src=\"https://www.googletagmanager.com/ns.html?id=GTM-12345678\""
        ]);
    }

    public static function getEnv()
    {
        return 'gtm';
    }
}