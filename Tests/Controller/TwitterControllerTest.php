<?php

namespace CommonJsBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TwitterControllerTest extends WebTestCase
{
    use ControllerTestTrait;

    public function testTwitter()
    {
        $client = $this->getClient();
        $this->assertUri($client, '/twitter');

        $this->assertResponseContains($client, [
            "The twitter code is not what was expected" => "(document, \"script\", \"twitter-wjs\"));",
            "The default twitter window variable could not be found." => "window.twttr"
        ]);
    }

    public static function getEnv()
    {
        return 'twitter';
    }
}