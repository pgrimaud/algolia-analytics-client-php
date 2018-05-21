<?php

namespace Algolia\Resource;

use Algolia\Response\Hit\HitTopResponse;

class Hit extends AbstractResource
{
    /**
     * @param                $index
     * @param \DateTime|null $startDate
     * @param \DateTime|null $endDate
     * @return HitTopResponse
     * @throws \Algolia\Transport\Exception\ClientException
     */
    public function top($index, \DateTime $startDate = null, \DateTime $endDate = null)
    {
        $endpoint = 'hits?index=' . $index;
        $endpoint = $this->manageDates($endpoint, $startDate, $endDate);

        $endpoint = $this->generateEndpoint($endpoint);
        $response = $this->client->request($endpoint);

        return new HitTopResponse($response);
    }

    /**
     * @param                $index
     * @param \DateTime|null $startDate
     * @param \DateTime|null $endDate
     * @param null           $search
     * @return HitTopResponse
     * @throws \Algolia\Transport\Exception\ClientException
     */
    public function search($index, \DateTime $startDate = null, \DateTime $endDate = null, $search = null)
    {
        $endpoint = 'hits?index=' . $index;
        $endpoint = $this->manageDates($endpoint, $startDate, $endDate);

        if ($search) {
            $endpoint .= '&search=' . $search;
        }

        $endpoint = $this->generateEndpoint($endpoint);
        $response = $this->client->request($endpoint);

        return new HitTopResponse($response);
    }
}
