<?php

namespace JsSdkBundle\Tests\TestBundle\Tests;

use JsSdkBundle\Tests\Kernel;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestControllerTest extends WebTestCase
{
    public function testNoConfig()
    {
        $client = static::createClient(array(
            'environment' => 'empty',
            'debug'       => true,
        ));
        $client->request('GET', '/empty');
        $response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
    }
    protected static function getKernelClass()
    {
        return Kernel::class;
    }
}