<?php

namespace Algolia\Resource;

use Algolia\Response\Filter\FilterForAttributesResponse;
use Algolia\Response\Filter\FilterNoResultsResponse;
use Algolia\Response\Filter\FilterTopResponse;

class Filter extends AbstractResource
{
    /**
     * @param                $index
     * @param \DateTime|null $startDate
     * @param \DateTime|null $endDate
     * @return FilterTopResponse
     * @throws \Algolia\Transport\Exception\ClientException
     */
    public function top($index, \DateTime $startDate = null, \DateTime $endDate = null)
    {
        $endpoint = 'filters?index=' . $index;
        $endpoint = $this->manageDates($endpoint, $startDate, $endDate);

        $endpoint = $this->generateEndpoint($endpoint);
        $response = $this->client->request($endpoint);

        return new FilterTopResponse($response);
    }

    /**
     * @param                $index
     * @param \DateTime|null $startDate
     * @param \DateTime|null $endDate
     * @param null           $search
     * @return FilterTopResponse
     * @throws \Algolia\Transport\Exception\ClientException
     */
    public function search($index, \DateTime $startDate = null, \DateTime $endDate = null, $search = null)
    {
        $endpoint = 'filters?index=' . $index;
        $endpoint = $this->manageDates($endpoint, $startDate, $endDate);

        if ($search) {
            $endpoint .= '&search=' . $search;
        }

        $endpoint = $this->generateEndpoint($endpoint);
        $response = $this->client->request($endpoint);

        return new FilterTopResponse($response);
    }

    /**
     * @param                $index
     * @param \DateTime|null $startDate
     * @param \DateTime|null $endDate
     * @param null           $search
     * @return FilterNoResultsResponse
     * @throws \Algolia\Transport\Exception\ClientException
     */
    public function noResults($index, \DateTime $startDate = null, \DateTime $endDate = null, $search = null)
    {
        $endpoint = 'filters/noResults?index=' . $index;
        $endpoint = $this->manageDates($endpoint, $startDate, $endDate);

        if ($search) {
            $endpoint .= '&search=' . $search;
        }

        $endpoint = $this->generateEndpoint($endpoint);
        $response = $this->client->request($endpoint);

        return new FilterNoResultsResponse($response);
    }

    /**
     * @param                $index
     * @param                $attributes
     * @param \DateTime|null $startDate
     * @param \DateTime|null $endDate
     * @param null           $search
     * @return FilterForAttributesResponse
     * @throws \Algolia\Transport\Exception\ClientException
     */
    public function topFiltersForAttributes(
        $index,
        $attributes = [],
        \DateTime $startDate = null,
        \DateTime $endDate = null,
        $search = null
    )
    {
        $endpoint = 'filters/' . implode($attributes, ',') . '?index=' . $index;
        $endpoint = $this->manageDates($endpoint, $startDate, $endDate);

        if ($search) {
            $endpoint .= '&search=' . $search;
        }

        $endpoint = $this->generateEndpoint($endpoint);
        $response = $this->client->request($endpoint);

        return new FilterForAttributesResponse($response);
    }
}
