<?php

namespace Algolia\Resource;

use Algolia\Transport\Client;

abstract class AbstractResource
{
    const ANALYTICS_DOMAIN = 'ANALYTICS';
    const CLICK_DOMAIN     = 'CLICK';

    const ANALYTICS_URI = 'https://analytics.algolia.com/2/';
    const CLICK_URI     = 'https://insights.algolia.io/2/';

    /**
     * @var Client
     */
    protected $client;

    /**
     * AbstractResource constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $endpoint
     * @param string $domain
     * @return string
     */
    protected function generateEndpoint($endpoint = '', $domain = self::ANALYTICS_DOMAIN)
    {
        $uri = $domain === self::ANALYTICS_DOMAIN ? self::ANALYTICS_URI : self::CLICK_URI;

        return $uri . $endpoint;
    }

    /**
     * @param $endpoint
     * @param $startDate
     * @param $endDate
     * @return string
     */
    protected function manageDates($endpoint, $startDate, $endDate)
    {
        if ($startDate instanceof \DateTime) {
            $endpoint .= '&startDate=' . $startDate->format('Y-m-d');
        }

        if ($endDate instanceof \DateTime) {
            $endpoint .= '&endDate=' . $endDate->format('Y-m-d');
        }

        return $endpoint;
    }
}
