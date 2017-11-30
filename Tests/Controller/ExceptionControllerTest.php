<?php

namespace Silverback\CommonJsBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ExceptionControllerTest extends WebTestCase
{
    use ControllerTestTrait;

    public function testNoName()
    {
        $client = $this->getClient();
        $crawler = $this->assertUri($client, '/exception/no-name', false);
        $this->assertEquals($client->getResponse()->getStatusCode(), 500);
        $this->assertResponseContains($client, [
            "Message should let user know to enable the bundle" => "you should enable it in your config file"
        ], $crawler);
    }

    public function testNoParam()
    {
        $client = $this->getClient();
        $crawler = $this->assertUri($client, '/exception/no-param', false);
        $this->assertEquals($client->getResponse()->getStatusCode(), 500);
        $this->assertResponseContains($client, [
            "Message should let user know where the variable is missing from" => "missing a parameter for `google_analytics::ec/add_impression`: Variable \"impression\""
        ], $crawler);
    }

    public static function getEnv()
    {
        return 'exception';
    }
}
