<?php

namespace Algolia\Resource;

use Algolia\Response\Search\SearchCountResponse;
use Algolia\Response\Search\SearchNoResultRateResponse;
use Algolia\Response\Search\SearchNoResultsResponse;
use Algolia\Response\Search\SearchTopResponse;

class Search extends AbstractResource
{
    /**
     * @param                $index
     * @param \DateTime|null $startDate
     * @param \DateTime|null $endDate
     * @return SearchCountResponse
     * @throws \Algolia\Transport\Exception\ClientException
     */
    public function count($index, \DateTime $startDate = null, \DateTime $endDate = null)
    {
        $endpoint = 'searches/count?index=' . $index;
        $endpoint = $this->manageDates($endpoint, $startDate, $endDate);

        $endpoint = $this->generateEndpoint($endpoint);
        $response = $this->client->request($endpoint);

        return new SearchCountResponse($response);
    }

    /**
     * @param                $index
     * @param \DateTime|null $startDate
     * @param \DateTime|null $endDate
     * @param bool           $clickAnalytics
     * @param null           $orderBy
     * @param null           $direction
     * @return SearchTopResponse
     * @throws \Algolia\Transport\Exception\ClientException
     */
    public function top(
        $index,
        \DateTime $startDate = null,
        \DateTime $endDate = null,
        $clickAnalytics = true,
        $orderBy = null,
        $direction = null
    ) {
        $endpoint = 'searches?index=' . $index;
        if ($clickAnalytics) {
            $endpoint .= '&clickAnalytics=true';
        }

        $endpoint = $this->manageDates($endpoint, $startDate, $endDate);

        if ($orderBy) {
            $endpoint .= '&orderBy=' . $orderBy;
        }

        if ($direction) {
            $endpoint .= '&direction=' . $direction;
        }

        $endpoint = $this->generateEndpoint($endpoint);
        $response = $this->client->request($endpoint);

        return new SearchTopResponse($response);
    }

    /**
     * @param                $index
     * @param \DateTime|null $startDate
     * @param \DateTime|null $endDate
     * @return SearchNoResultsResponse
     * @throws \Algolia\Transport\Exception\ClientException
     */
    public function noResults($index, \DateTime $startDate = null, \DateTime $endDate = null)
    {
        $endpoint = 'searches/noResults?index=' . $index;
        $endpoint = $this->manageDates($endpoint, $startDate, $endDate);

        $endpoint = $this->generateEndpoint($endpoint);
        $response = $this->client->request($endpoint);

        return new SearchNoResultsResponse($response);
    }

    /**
     * @param                $index
     * @param \DateTime|null $startDate
     * @param \DateTime|null $endDate
     * @return SearchNoResultRateResponse
     * @throws \Algolia\Transport\Exception\ClientException
     */
    public function noResultRate($index, \DateTime $startDate = null, \DateTime $endDate = null)
    {
        $endpoint = 'searches/noResults?index=' . $index;
        $endpoint = $this->manageDates($endpoint, $startDate, $endDate);

        $endpoint = $this->generateEndpoint($endpoint);
        $response = $this->client->request($endpoint);

        return new SearchNoResultRateResponse($response);
    }
}
