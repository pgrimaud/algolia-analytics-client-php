<?php

namespace Tests\Algolia\Analytics;

use Algolia\Response\Search\Result\SearchNoResultRateResult;
use Algolia\Response\Search\Result\SearchNoResultsResult;
use Algolia\Response\Search\Result\SearchResult;
use Algolia\Response\Search\SearchCountResponse;
use Algolia\Response\Search\SearchDateResponse;
use Algolia\Response\Search\SearchNoResultRateResponse;
use Algolia\Response\Search\SearchNoResultsResponse;
use Algolia\Response\Search\SearchTopResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class SearchTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @throws \Algolia\Transport\Exception\ClientException
     */
    public function testTop()
    {
        $filterFixtures = file_get_contents(__DIR__ . '/fixtures/searches/top.json');

        $response = new Response(200, [], $filterFixtures);
        $mock     = new MockHandler([$response]);
        $handler  = HandlerStack::create($mock);
        $client   = new Client(['handler' => $handler]);

        $analytics = new \Algolia\Analytics('', '', $client);

        $startDate = new \DateTime('-30 days');
        $endDate   = new \DateTime();

        /** @var SearchTopResponse $response */
        $response = $analytics->searches->top('dev_pages', $startDate, $endDate);

        $this->assertInstanceOf(SearchTopResponse::class, $response);

        /** @var SearchResult $result */
        $result = $response->getResults()[0];

        $this->assertSame(2, $result->getCount());
        $this->assertSame(1, $result->getNbHits());
        $this->assertSame('q1', $result->getSearch());
    }

    /**
     * @throws \Algolia\Transport\Exception\ClientException
     */
    public function testTopWithFilters()
    {
        $filterFixtures = file_get_contents(__DIR__ . '/fixtures/searches/top.json');

        $response = new Response(200, [], $filterFixtures);
        $mock     = new MockHandler([$response]);
        $handler  = HandlerStack::create($mock);
        $client   = new Client(['handler' => $handler]);

        $analytics = new \Algolia\Analytics('', '', $client);

        $startDate = new \DateTime('-30 days');
        $endDate   = new \DateTime();

        /** @var SearchTopResponse $response */
        $response = $analytics->searches->top('dev_pages', $startDate, $endDate, true, 'date', 'asc');

        $this->assertInstanceOf(SearchTopResponse::class, $response);

        /** @var SearchResult $result */
        $result = $response->getResults()[0];

        $this->assertSame(2, $result->getCount());
        $this->assertSame(1, $result->getNbHits());
        $this->assertSame('q1', $result->getSearch());
    }

    /**
     * @throws \Algolia\Transport\Exception\ClientException
     */
    public function testCount()
    {
        $filterFixtures = file_get_contents(__DIR__ . '/fixtures/searches/count.json');

        $response = new Response(200, [], $filterFixtures);
        $mock     = new MockHandler([$response]);
        $handler  = HandlerStack::create($mock);
        $client   = new Client(['handler' => $handler]);

        $analytics = new \Algolia\Analytics('', '', $client);

        $startDate = new \DateTime('-30 days');
        $endDate   = new \DateTime();

        /** @var SearchCountResponse $response */
        $response = $analytics->searches->count('dev_pages', $startDate, $endDate);

        $this->assertInstanceOf(SearchCountResponse::class, $response);

        /** @var SearchDateResponse $result */
        $result = $response->getDates()[0];

        $this->assertSame(1, $result->getCount());
        $this->assertInstanceOf(\DateTime::class, $result->getDate());
    }

    /**
     * @throws \Algolia\Transport\Exception\ClientException
     */
    public function testNoResults()
    {
        $filterFixtures = file_get_contents(__DIR__ . '/fixtures/searches/noresults.json');

        $response = new Response(200, [], $filterFixtures);
        $mock     = new MockHandler([$response]);
        $handler  = HandlerStack::create($mock);
        $client   = new Client(['handler' => $handler]);

        $analytics = new \Algolia\Analytics('', '', $client);

        $startDate = new \DateTime('-30 days');
        $endDate   = new \DateTime();

        /** @var SearchNoResultsResponse $response */
        $response = $analytics->searches->noResults('dev_pages', $startDate, $endDate);

        $this->assertInstanceOf(SearchNoResultsResponse::class, $response);

        /** @var SearchNoResultsResult $result */
        $result = $response->getResults()[0];

        $this->assertSame(2, $result->getCount());
        $this->assertSame('q1', $result->getSearch());
        $this->assertSame(1, $result->getWithFilterCount());
    }

    /**
     * @throws \Algolia\Transport\Exception\ClientException
     */
    public function testNoResultRate()
    {
        $filterFixtures = file_get_contents(__DIR__ . '/fixtures/searches/noresultrate.json');

        $response = new Response(200, [], $filterFixtures);
        $mock     = new MockHandler([$response]);
        $handler  = HandlerStack::create($mock);
        $client   = new Client(['handler' => $handler]);

        $analytics = new \Algolia\Analytics('', '', $client);

        $startDate = new \DateTime('-30 days');
        $endDate   = new \DateTime();

        /** @var SearchNoResultRateResponse $response */
        $response = $analytics->searches->noResultRate('dev_pages', $startDate, $endDate);

        $this->assertInstanceOf(SearchNoResultRateResponse::class, $response);

        $this->assertSame(0.42857142857142855, $response->getRate());
        $this->assertSame(6, $response->getNoResultCount());
        $this->assertSame(14, $response->getCount());

        /** @var SearchNoResultRateResult $result */
        $result = $response->getResults()[0];

        $this->assertSame(10, $result->getCount());
        $this->assertInstanceOf(\DateTime::class, $result->getDate());
        $this->assertSame(5, $result->getNoResultCount());
        $this->assertSame(0.5, $result->getRate());
    }
}
