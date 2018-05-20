<?php

namespace Algolia\Response\Country;

class CountryResult
{
    /**
     * @var string
     */
    private $country;

    /**
     * @var int
     */
    private $count;

    /**
     * CountryResult constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->country = $data->country;
        $this->count   = $data->count;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }
}
