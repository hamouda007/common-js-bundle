<?php

namespace CommonJsBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FacebookSdkControllerTest extends WebTestCase
{
    use ControllerTestTrait;

    public function testFacebookSdk()
    {
        $client = $this->getClient();
        $this->assertUri($client, '/facebook-sdk');

        $this->assertResponseContains($client, [
            "Not all the parameters were what as expected in the init function" => "FB.init({
      appId      : '12345678',
      xfbml      : true,
      version    : 'v2.11',
      status     : false
    });
",
            "The wrong sdk script is being loaded" => "js.src = \"//connect.facebook.net/en_GB/sdk.js\";"
        ]);
    }

    public static function getEnv()
    {
        return 'facebook_sdk';
    }
}