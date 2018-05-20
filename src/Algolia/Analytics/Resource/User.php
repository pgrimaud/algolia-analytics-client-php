<?php

namespace Algolia\Resource;

use Algolia\Response\User\UserCountResponse;

class User extends AbstractResource
{
    /**
     * @param string         $index
     * @param \DateTime|null $startDate
     * @param \DateTime|null $endDate
     * @return UserCountResponse
     * @throws \Algolia\Transport\Exception\ClientException
     */
    public function count($index, \DateTime $startDate = null, \DateTime $endDate = null)
    {
        $endpoint = 'users/count?index=' . $index;
        $endpoint = $this->manageDates($endpoint, $startDate, $endDate);

        $endpoint = $this->generateEndpoint($endpoint);
        $response = $this->client->request($endpoint);

        return new UserCountResponse($response);
    }
}
