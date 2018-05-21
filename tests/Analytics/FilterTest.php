<?php

namespace Tests\Algolia\Analytics;

use Algolia\Response\Filter\FilterForAttributesResponse;
use Algolia\Response\Filter\FilterNoResultsResponse;
use Algolia\Response\Filter\FilterTopResponse;
use Algolia\Response\Filter\Result\FilterForAttributesResult;
use Algolia\Response\Filter\Result\FilterNoResultResult;
use Algolia\Response\Filter\Result\FilterTopResult;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class FilterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @throws \Algolia\Transport\Exception\ClientException
     */
    public function testNoResults()
    {
        $filterFixtures = file_get_contents(__DIR__ . '/fixtures/filters/noresults.json');

        $response = new Response(200, [], $filterFixtures);
        $mock     = new MockHandler([$response]);
        $handler  = HandlerStack::create($mock);
        $client   = new Client(['handler' => $handler]);

        $analytics = new \Algolia\Analytics('', '', $client);

        $startDate = new \DateTime('-30 days');
        $endDate   = new \DateTime();

        /** @var FilterNoResultsResponse $response */
        $response = $analytics->filters->noResults('dev_pages', $startDate, $endDate);

        $this->assertInstanceOf(FilterNoResultsResponse::class, $response);

        /** @var FilterNoResultResult $result */
        $result = $response->getResults()[0];

        $this->assertSame(3, $result->getCount());
        $this->assertCount(2, $result->getValues());
    }

    /**
     * @throws \Algolia\Transport\Exception\ClientException
     */
    public function testNoResultsWithSearchValue()
    {
        $filterFixtures = file_get_contents(__DIR__ . '/fixtures/filters/noresults.json');

        $response = new Response(200, [], $filterFixtures);
        $mock     = new MockHandler([$response]);
        $handler  = HandlerStack::create($mock);
        $client   = new Client(['handler' => $handler]);

        $analytics = new \Algolia\Analytics('', '', $client);

        $startDate = new \DateTime('-30 days');
        $endDate   = new \DateTime();

        /** @var FilterNoResultsResponse $response */
        $response = $analytics->filters->noResults('dev_pages', $startDate, $endDate, 'test');

        $this->assertInstanceOf(FilterNoResultsResponse::class, $response);

        /** @var FilterNoResultResult $result */
        $result = $response->getResults()[0];

        $this->assertSame(3, $result->getCount());
        $this->assertCount(2, $result->getValues());
    }

    /**
     * @throws \Algolia\Transport\Exception\ClientException
     */
    public function testTop()
    {
        $filterFixtures = file_get_contents(__DIR__ . '/fixtures/filters/top.json');

        $response = new Response(200, [], $filterFixtures);
        $mock     = new MockHandler([$response]);
        $handler  = HandlerStack::create($mock);
        $client   = new Client(['handler' => $handler]);

        $analytics = new \Algolia\Analytics('', '', $client);

        $startDate = new \DateTime('-30 days');
        $endDate   = new \DateTime();

        /** @var FilterTopResponse $response */
        $response = $analytics->filters->top('dev_pages', $startDate, $endDate);

        /** @var FilterTopResult $result */
        $result = $response->getResults()[0];
        $this->assertSame(2, $result->getCount());
        $this->assertSame('brand', $result->getAttribute());
    }

    /**
     * @throws \Algolia\Transport\Exception\ClientException
     */
    public function testSearch()
    {
        $filterFixtures = file_get_contents(__DIR__ . '/fixtures/filters/search.json');

        $response = new Response(200, [], $filterFixtures);
        $mock     = new MockHandler([$response]);
        $handler  = HandlerStack::create($mock);
        $client   = new Client(['handler' => $handler]);

        $analytics = new \Algolia\Analytics('', '', $client);

        $startDate = new \DateTime('-30 days');
        $endDate   = new \DateTime();

        /** @var FilterTopResponse $response */
        $response = $analytics->filters->search('dev_pages', $startDate, $endDate, 'coucou');

        /** @var FilterTopResult $result */
        $result = $response->getResults()[0];
        $this->assertSame(2, $result->getCount());
        $this->assertSame('brand', $result->getAttribute());
    }

    /**
     * @throws \Algolia\Transport\Exception\ClientException
     */
    public function testFiltersForAttributes()
    {
        $filterFixtures = file_get_contents(__DIR__ . '/fixtures/filters/filterstoattributes.json');

        $response = new Response(200, [], $filterFixtures);
        $mock     = new MockHandler([$response]);
        $handler  = HandlerStack::create($mock);
        $client   = new Client(['handler' => $handler]);

        $analytics = new \Algolia\Analytics('', '', $client);

        $startDate = new \DateTime('-30 days');
        $endDate   = new \DateTime();

        /** @var FilterForAttributesResponse $response */
        $response = $analytics->filters->topFiltersForAttributes('dev_pages', ['test'], $startDate, $endDate, 'coucou');

        /** @var FilterForAttributesResult $result */
        $result = $response->getResults()[0];
        $this->assertSame(2, $result->getCount());
        $this->assertSame('brand', $result->getAttribute());
        $this->assertSame(':', $result->getOperator());
        $this->assertSame('apple', $result->getValue());
    }
}
