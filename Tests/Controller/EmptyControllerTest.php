<?php

namespace Silverback\CommonJsBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EmptyControllerTest extends WebTestCase
{
    use ControllerTestTrait;

    public function testEmpty()
    {
        $client = $this->getClient();
        $this->assertUri($client, '/empty');
    }

    public static function getEnv()
    {
        return 'empty';
    }
}