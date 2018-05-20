<?php

namespace Algolia;

use Algolia\Resource\Country;
use Algolia\Resource\Filter;
use Algolia\Resource\Hit;
use Algolia\Resource\Search;
use Algolia\Resource\User;

use Algolia\Transport\Client;

class Analytics
{
    /**
     * @var Country
     */
    public $countries;

    /**
     * @var Filter
     */
    public $filters;

    /**
     * @var Hit
     */
    public $hits;

    /**
     * @var Search
     */
    public $searches;

    /**
     * @var User
     */
    public $users;

    /**
     * Analytics constructor.
     * @param                         $applicationId
     * @param                         $apiKey
     * @param \GuzzleHttp\Client|null $client
     */
    public function __construct($applicationId, $apiKey, \GuzzleHttp\Client $client = null)
    {
        $guzzleClient  = $client ?: new \GuzzleHttp\Client();
        $algoliaClient = new Client($applicationId, $apiKey, $guzzleClient);

        $objects = [
            'countries' => new Country($algoliaClient),
            'filters'   => new Filter($algoliaClient),
            'hits'      => new Hit($algoliaClient),
            'searches'  => new Search($algoliaClient),
            'users'     => new User($algoliaClient),
        ];

        foreach ($objects as $property => $object) {
            $this->{$property} = $object;
        }
    }
}
