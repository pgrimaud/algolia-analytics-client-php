<?php

namespace Algolia\Resource;

use Algolia\Response\Country\CountryTopResponse;

class Country extends AbstractResource
{
    /**
     * @param                $index
     * @param \DateTime|null $startDate
     * @param \DateTime|null $endDate
     * @return CountryTopResponse
     * @throws \Algolia\Transport\Exception\ClientException
     */
    public function top($index, \DateTime $startDate = null, \DateTime $endDate = null)
    {
        $endpoint = 'countries?index=' . $index;
        $endpoint = $this->manageDates($endpoint, $startDate, $endDate);

        $endpoint = $this->generateEndpoint($endpoint);
        $response = $this->client->request($endpoint);

        return new CountryTopResponse($response);
    }
}
