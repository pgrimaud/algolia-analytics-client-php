<?php

namespace Algolia\Transport;

use Algolia\Transport\Exception\ClientException;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;

/**
 * Class Client
 * @package Algolia\Transport
 */
class Client
{
    /**
     * @var Client
     */
    private $guzzleClient;

    /**
     * @var string
     */
    private $applicationId;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * Client constructor.
     * @param                    $applicationId
     * @param                    $apiKey
     * @param \GuzzleHttp\Client $guzzleClient
     */
    public function __construct($applicationId, $apiKey, \GuzzleHttp\Client $guzzleClient)
    {
        $this->guzzleClient  = $guzzleClient;
        $this->applicationId = $applicationId;
        $this->apiKey        = $apiKey;
    }

    /**
     * @param $url
     * @return mixed
     * @throws ClientException
     */
    public function request($url)
    {
        try {
            /** @var Response $response */
            $response = $this->guzzleClient->request('GET', $url, [
                'headers' => [
                    'X-Algolia-Application-Id' => $this->applicationId,
                    'X-Algolia-API-Key'        => $this->apiKey,
                ],
            ]);
        } catch (RequestException $e) {
            $errorResponse = (string)$e->getResponse()->getBody();

            $data = json_decode($errorResponse);

            if (json_last_error() == JSON_ERROR_NONE) {
                throw new ClientException('Error ' . $data->status . ' : ' . $data->message);
            } else {
                throw new ClientException($e->getMessage());
            }
        } catch (GuzzleException $e) {
            throw new ClientException($e->getMessage());
        }

        $data = json_decode((string)$response->getBody());

        if (json_last_error() != JSON_ERROR_NONE) {
            throw new ClientException('JSON malformed');
        }

        return $data;
    }
}
