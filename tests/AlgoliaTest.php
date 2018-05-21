<?php

namespace Tests\Algolia\Analytics;

use Algolia\Transport\Exception\ClientException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class AlgoliaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Client
     */
    private $emptyClient;

    /**
     * @var Client
     */
    private $invalidClient;

    /**
     * @var Client
     */
    private $invalidAndEmptyClient;

    /**
     * @var Client
     */
    private $invalidTransferClient;

    /**
     * @return void
     */
    public function setUp()
    {
        $response          = new Response(200, [], '');
        $mock              = new MockHandler([$response]);
        $handler           = HandlerStack::create($mock);
        $this->emptyClient = new Client(['handler' => $handler]);

        $response            = new Response(411, [], json_encode(['status' => 411, 'message' => 'Error']));
        $mock                = new MockHandler([$response]);
        $handler             = HandlerStack::create($mock);
        $this->invalidClient = new Client(['handler' => $handler]);

        $response                    = new Response(411, []);
        $mock                        = new MockHandler([$response]);
        $handler                     = HandlerStack::create($mock);
        $this->invalidAndEmptyClient = new Client(['handler' => $handler]);

        $mock                        = new MockHandler([
            new TransferException('Error')
        ]);
        $handler                     = HandlerStack::create($mock);
        $this->invalidTransferClient = new Client(['handler' => $handler]);
    }

    /**
     * @throws \Algolia\Transport\Exception\ClientException
     */
    public function testEmptyClient()
    {
        $this->expectException(ClientException::class);

        $analytics = new \Algolia\Analytics('', '', $this->emptyClient);

        $startDate = new \DateTime('-30 days');
        $endDate   = new \DateTime();

        $analytics->countries->top('dev_pages', $startDate, $endDate);
    }

    /**
     * @throws \Algolia\Transport\Exception\ClientException
     */
    public function testInvalidClient()
    {
        $this->expectException(ClientException::class);

        $analytics = new \Algolia\Analytics('', '', $this->invalidClient);

        $startDate = new \DateTime('-30 days');
        $endDate   = new \DateTime();

        $analytics->countries->top('dev_pages', $startDate, $endDate);
    }

    /**
     * @throws \Algolia\Transport\Exception\ClientException
     */
    public function testInvalidAndEmptyClient()
    {
        $this->expectException(ClientException::class);

        $analytics = new \Algolia\Analytics('', '', $this->invalidAndEmptyClient);

        $startDate = new \DateTime('-30 days');
        $endDate   = new \DateTime();

        $analytics->countries->top('dev_pages', $startDate, $endDate);
    }

    /**
     * @throws \Algolia\Transport\Exception\ClientException
     */
    public function testInvalidTransfertException()
    {
        $this->expectException(ClientException::class);

        $analytics = new \Algolia\Analytics('', '', $this->invalidTransferClient);

        $startDate = new \DateTime('-30 days');
        $endDate   = new \DateTime();

        $analytics->countries->top('dev_pages', $startDate, $endDate);
    }
}
