<?php

namespace Algolia\Response\Search\Result;

class SearchResult
{
    /**
     * @var string
     */
    private $search;

    /**
     * @var int
     */
    private $count;

    /**
     * @var int
     */
    private $nbHits;

    /**
     * SearchCountResponse constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->search = $data->search;
        $this->count  = $data->count;
        $this->nbHits = $data->nbHits;
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
    public function getNbHits()
    {
        return $this->nbHits;
    }
}
