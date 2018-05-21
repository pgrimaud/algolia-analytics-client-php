<?php

namespace Tests\Algolia\Analytics;

use Algolia\Response\User\UserCountResponse;
use Algolia\Response\User\UserDateResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class UserTest extends \PHPUnit_Framework_TestCase
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
        $userFixtures = file_get_contents(__DIR__ . '/fixtures/users/top.json');

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

        /** @var UserCountResponse $response */
        $response = $analytics->users->count('dev_pages', $startDate, $endDate);

        $this->assertInstanceOf(UserCountResponse::class, $response);

        $this->assertSame(3, $response->getCount());

        /** @var UserDateResponse $date */
        $date = $response->getDates()[0];
        $this->assertInstanceOf(\DateTime::class, $date->getDate());
        $this->assertSame(1, $date->getCount());
    }
}
