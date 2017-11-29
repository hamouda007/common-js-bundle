<?php

namespace CommonJsBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GoogleAnalyticsControllerTest extends WebTestCase
{
    use ControllerTestTrait;

    public static function getEnv()
    {
        return 'google_analytics';
    }

    public function testGoogleAnalytics()
    {
        $client = $this->getClient();
        $this->assertUri($client, '/google-analytics');
        self::assertEquals(getenv('GOOGLE_ANALYTICS_ID'), 'UA-12345678');

        $this->assertResponseContains($client, [
            "The Google tracking ID is not being read in properly" => getenv('GOOGLE_ANALYTICS_ID'),
            "The debug parameter is not being implemented properly for Google Analytics" => '\'https://www.google-analytics.com/analytics_debug.js\'',
            "The Google tracking code is not all included or is not in the correct order" => "ga('set', 'currencyCode', 'GBP');\nga('send', 'pageview');",
        ]);
    }

    public function testGoogleAnalyticsDuplicate()
    {
        $client = $this->getClient();
        $this->assertUri($client, '/google-analytics/duplicate');

        $this->assertResponseContains($client, [
            "The Google tracking ID is not being read in properly" => getenv('GOOGLE_ANALYTICS_ID'),
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
        $client = $this->getClient();
        $this->assertUri($client, '/google-analytics/set');
        $this->assertResponseContains($client, [
            "The set block was not inserted for Google Analytics" => "ga('set', 'key', 'value');"
        ]);
    }

    public function testGoogleAnalyticsEvent()
    {
        $client = $this->getClient();
        $this->assertUri($client, '/google-analytics/event');
        $this->assertResponseContains($client, [
            "The event tracking block was not inserted for Google Analytics" => "ga('send', 'event', {\"category\":\"category\",\"action\":\"action\",\"label\":\"label\",\"transport\":\"beacon\",\"nonInteraction\":true});"
        ]);
    }

    public function testGoogleAnalyticsReturnJavascript()
    {
        $client = $this->getClient();
        $this->assertUri($client, '/google-analytics/return-js');
        $this->assertResponseContains($client, [
            "The event tracking block was not returned for Google Analytics" => "ga('send', 'event', {\"category\":\"category\",\"action\":\"action\",\"nonInteraction\":false});"
        ]);
    }

    public function testGoogleAnalyticsEc()
    {
        $client = $this->getClient();
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
        $client = $this->getClient();
        $crawler = $this->assertUri($client, '/google-analytics/ec-invalid', false);
        $this->assertEquals(500, $client->getResponse()->getStatusCode(), "500 error expected for an invalid model");
        $this->assertResponseContains($client, [
            "The expected error message is missing" => "Either ID or Name is required"
        ], $crawler);
    }
}