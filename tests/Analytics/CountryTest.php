<?php

namespace Tests\Algolia\Analytics;

use Algolia\Response\Country\CountryResult;
use Algolia\Response\Country\CountryTopResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class CountryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @return void
     */
    public function setUp()
    {
        $userFixtures = file_get_contents(__DIR__ . '/fixtures/countries/top.json');

        $response     = new Response(200, [], $userFixtures);
        $mock         = new MockHandler([$response]);
        $handler      = HandlerStack::create($mock);
        $this->client = new Client(['handler' => $handler]);
    }

    /**
     * @throws \Algolia\Transport\Exception\ClientException
     */
    public function testEmptyClient()
    {
        $analytics = new \Algolia\Analytics('', '', $this->client);

        $startDate = new \DateTime('-30 days');
        $endDate   = new \DateTime();

        /** @var CountryTopResponse $response */
        $response = $analytics->countries->top('dev_pages', $startDate, $endDate);

        $this->assertInstanceOf(CountryTopResponse::class, $response);

        /** @var CountryResult $country */
        $country = $response->getResults()[0];

        $this->assertSame(2, $country->getCount());
        $this->assertSame('US', $country->getCountry());
    }
}
