<?php

namespace Algolia\Response\Search\Result;

class SearchNoResultRateResult
{
    /**
     * @var \DateTime $date
     */
    private $date;

    /**
     * @var float
     */
    private $rate;

    /**
     * @var int
     */
    private $count;

    /**
     * @var int
     */
    private $noResultCount;

    /**
     * SearchNoResultRateResult constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->date          = new \DateTime($data->date);
        $this->rate          = $data->rate;
        $this->count         = $data->count;
        $this->noResultCount = $data->noResultCount;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return float
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @return int
     */
    public function getNoResultCount()
    {
        return $this->noResultCount;
    }
}
