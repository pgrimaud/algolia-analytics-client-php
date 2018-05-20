<?php

namespace Algolia\Response\Country;

class CountryTopResponse
{
    /**
     * @var array
     */
    private $results = [];

    /**
     * CountryTopResponse constructor.
     * @param $data
     */
    public function __construct($data)
    {
        foreach ($data->countries as $country) {
            $this->results[] = new CountryResult($country);
        }
    }
}
