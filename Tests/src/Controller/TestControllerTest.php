<?php

namespace JsSdkBundle\Tests\src;

use JsSdkBundle\Tests\Kernel;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Yaml\Yaml;

class TestControllerTest extends WebTestCase
{
    public function testEmpty()
    {
        $client = $this->getClient('empty');
        $this->assertUri($client, '/empty');
    }

    public function testGoogleAnalytics()
    {
        $env = 'google_analytics';
        $client = $this->getClient($env);
        $crawler = $this->assertUri($client, '/google-analytics');

        // test each variable exists in the template
        $data = $this->getParsedConfig($env);
        $this->assertResponseContains($client, [
            $data['id'],
            'pageview'
        ]);

    }

    private function getParsedConfig(string $env)
    {
        $data = Yaml::parse(file_get_contents(__DIR__ . '/../../config/packages/' . $env . '/js_sdk.yaml'));
        return $data['js_sdk'][$env];
    }

    private function assertResponseContains(Client $client, $datum)
    {
        if (!is_array($datum)) {
            $datum = [$datum];
        }
        foreach ($datum as $data) {
            $this->assertContains($data, $client->getResponse()->getContent());
        }
    }

    private function getClient($env)
    {
        return static::createClient(array(
            'environment' => $env,
            'debug'       => false,
        ));
    }

    private function assertUri(Client $client, $uri)
    {
        $crawler = $client->request('GET', $uri);
        $this->assertTrue($client->getResponse()->isSuccessful());
        return $crawler;
    }

    protected static function getKernelClass()
    {
        return Kernel::class;
    }
}