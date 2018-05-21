<?php

namespace Tests\Algolia\Analytics;

use Algolia\Response\Filter\FilterNoResultsResponse;
use Algolia\Response\Hit\HitResult;
use Algolia\Response\Hit\HitTopResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class HitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @throws \Algolia\Transport\Exception\ClientException
     */
    public function testTop()
    {
        $filterFixtures = file_get_contents(__DIR__ . '/fixtures/hits/top.json');

        $response = new Response(200, [], $filterFixtures);
        $mock     = new MockHandler([$response]);
        $handler  = HandlerStack::create($mock);
        $client   = new Client(['handler' => $handler]);

        $analytics = new \Algolia\Analytics('', '', $client);

        $startDate = new \DateTime('-30 days');
        $endDate   = new \DateTime();

        /** @var HitTopResponse $response */
        $response = $analytics->hits->top('dev_pages', $startDate, $endDate);

        $this->assertInstanceOf(HitTopResponse::class, $response);

        /** @var HitResult $result */
        $result = $response->getResults()[0];

        $this->assertSame(2, $result->getCount());
        $this->assertSame('hit1', $result->getHit());
    }

    /**
     * @throws \Algolia\Transport\Exception\ClientException
     */
    public function testSearch()
    {
        $filterFixtures = file_get_contents(__DIR__ . '/fixtures/hits/search.json');

        $response = new Response(200, [], $filterFixtures);
        $mock     = new MockHandler([$response]);
        $handler  = HandlerStack::create($mock);
        $client   = new Client(['handler' => $handler]);

        $analytics = new \Algolia\Analytics('', '', $client);

        $startDate = new \DateTime('-30 days');
        $endDate   = new \DateTime();

        /** @var HitTopResponse $response */
        $response = $analytics->hits->search('dev_pages', $startDate, $endDate, 'toto');

        $this->assertInstanceOf(HitTopResponse::class, $response);

        /** @var HitResult $result */
        $result = $response->getResults()[0];

        $this->assertSame(2, $result->getCount());
        $this->assertSame('hit1', $result->getHit());
    }
}
