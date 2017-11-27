<?php

namespace JsSdkBundle\Tests\src;

use JsSdkBundle\Tests\Kernel;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
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
        $this->assertUri($client, '/google-analytics');

        // test contents for known strings that should exist
        $data = $this->getParsedConfig($env);
        $this->assertResponseContains($client, [
            "The Google tracking ID is not being read in properly" => $data['id'],
            "The debug parameter is not being implemented properly for Google Analytics" => '\'https://www.google-analytics.com/analytics_debug.js\'',
            "The Google tracking code is not all included or is not in the correct order" => "ga('set', 'currencyCode', 'GBP');\nga('send', 'pageview');",
        ]);
    }

    public function testGoogleAnalyticsDuplicate()
    {
        $env = 'google_analytics';
        $client = $this->getClient($env);
        $this->assertUri($client, '/google-analytics/duplicate');

        $data = $this->getParsedConfig($env);
        $this->assertResponseContains($client, [
            "The Google tracking ID is not being read in properly" => $data['id'],
            "The debug parameter is not being implemented properly for Google Analytics" => '\'https://www.google-analytics.com/analytics_debug.js\'',
            "The Google tracking code is not all included or is not in the correct order" => "ga('set', 'currencyCode', 'GBP');\nga('send', 'pageview');",
            "A duplicate Google tracking ID is not inserted into the template as expected" => 'UA-98765432',
            "Overriding the analytics function from the twig template is not working correctly" => 'ga_extra(\'send\', \'pageview\');',
            "Initialising a second analytics function with a different variable name from the twig template is not working properly" => 'analytics_debug.js\', \'ga_extra\'',
            "The ec/init block for ga_extra should have been cloned" => 'ga_extra(\'set\', \'currencyCode\', \'GBP\');'
        ]);
        $this->assertNotContains('ga_extra_extra(\'set\', \'currencyCode\', \'GBP\');', $client->getResponse()->getContent(), "The ec/init block for ga_extra should have been removed");
    }

    public function testGoogleAnalyticsSet()
    {
        $env = 'google_analytics';
        $client = $this->getClient($env);
        $this->assertUri($client, '/google-analytics/set');
        $this->assertResponseContains($client, [
            "The set block was not inserted for Google Analytics" => "ga('set', 'key', 'value');"
        ]);
    }

    public function testGoogleAnalyticsEvent()
    {
        $env = 'google_analytics';
        $client = $this->getClient($env);
        $this->assertUri($client, '/google-analytics/event');
        $this->assertResponseContains($client, [
            "The event tracking block was not inserted for Google Analytics" => "ga('send', 'event', {\"category\":\"category\",\"action\":\"action\",\"label\":\"label\",\"transport\":\"beacon\",\"nonInteraction\":true});"
        ]);
    }

    public function testGoogleAnalyticsReturnJavascript()
    {
        $env = 'google_analytics';
        $client = $this->getClient($env);
        $this->assertUri($client, '/google-analytics/return-js');
        $this->assertResponseContains($client, [
            "The event tracking block was not returned for Google Analytics" => "ga('send', 'event', {\"category\":\"category\",\"action\":\"action\",\"nonInteraction\":false});"
        ]);
    }

    public function testGoogleAnalyticsEc()
    {
        $env = 'google_analytics';
        $client = $this->getClient($env);
        $this->assertUri($client, '/google-analytics/ec');
        $this->assertResponseContains($client, [
            "ec/setAction is missing" => "ga('ec:setAction', \"click\", {\"id\":\"no link\",\"name\":\"click\"})",
            "ec/addImpression is missing" => "ga('ec:addImpression', {\"id\":\"SKU1\",\"name\":\"A Book\",\"list\":\"Books\"})",
            "ec/addProduct is missing" => "ga('ec:addProduct', {\"id\":\"SKU1\",\"name\":\"A Book\"});",
            "ec/addPromo is missing" => "ga('ec:addPromo', {\"id\":\"PROMO1\",\"name\":\"The Best Promotion Ever\"});"
        ]);
    }

    public function testGoogleAnalyticsInvalidEc()
    {
        $env = 'google_analytics';
        $client = $this->getClient($env);
        $this->assertUri($client, '/google-analytics/ec-invalid', false);
        $this->assertEquals(500, $client->getResponse()->getStatusCode(), "500 error expected for an invalid model");
        $this->assertResponseContains($client, [
            "The expected error message is missing" => "Either ID or Name is required"
        ]);
    }

    public function testMissingParameterException()
    {
        $env = 'empty';
        $client = $this->getClient($env);
        $this->assertUri($client, '/google-analytics', false);
        $this->assertEquals(500, $client->getResponse()->getStatusCode(), "With twig strict variables, a 500 response should be returned as some twig variables are missing");
        $this->assertResponseContains($client, [
            "The error response should be customised to give more information about which block in js_sdk is missing a variable" => 'js_sdk blocks'
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
        foreach ($datum as $message=>$data) {
            $this->assertContains($data, $client->getResponse()->getContent(), $message);
        }
    }

    private function getClient($env)
    {
        return static::createClient(array(
            'environment' => $env,
            'debug'       => false,
        ));
    }

    private function assertUri(Client $client, $uri, bool $assertSuccess = true)
    {
        $crawler = $client->request('GET', $uri);
        if ($assertSuccess) {
            $titleTag = $crawler->filter('title');
            $this->assertTrue($client->getResponse()->isSuccessful(), $titleTag->count() ? $titleTag->text() : 'No title tag found to extract exception message from');
        }
        return $crawler;
    }

    protected static function getKernelClass()
    {
        return Kernel::class;
    }
}