<?php

namespace CommonJsBundle\Tests\Controller;

use CommonJsBundle\Tests\Kernel;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpKernel\Client;

trait ControllerTestTrait
{
    private function assertResponseContains(Client $client, $datum, Crawler $crawler = null)
    {
        if (!is_array($datum)) {
            $datum = [$datum];
        }
        foreach ($datum as $message=>$data) {
            $this->assertContains($data, !$client->getResponse()->isSuccessful() && $crawler ? $crawler->filter('title')->text() : $client->getResponse()->getContent(), $message);
        }
    }

    /**
     * @param string|null $env
     * @return Client
     */
    private function getClient(string $env = null)
    {
        return static::createClient([
            'environment' => $env ?: self::getEnv(),
            'debug'       => false,
        ]);
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

    public static function getEnv()
    {
        return 'test';
    }
}