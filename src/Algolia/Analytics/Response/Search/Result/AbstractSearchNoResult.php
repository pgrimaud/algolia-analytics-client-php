<?php

namespace Algolia\Response\Search\Result;

class AbstractSearchNoResult
{
    /**
     * @var string
     */
    protected $search;

    /**
     * @var int
     */
    protected $count;

    /**
     * @var int
     */
    protected $withFilterCount;

    /**
     * SearchCountResponse constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->search          = $data->search;
        $this->count           = $data->count;
        $this->withFilterCount = $data->withFilterCount;
    }

    /**
     * @return string
     */
    public function getSearch()
    {
        return $this->search;
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
    public function getWithFilterCount()
    {
        return $this->withFilterCount;
    }
}
