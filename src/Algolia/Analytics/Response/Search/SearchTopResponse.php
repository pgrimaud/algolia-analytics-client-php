<?php

namespace Algolia\Response\Search;

use Algolia\Response\Search\Result\SearchResult;

class SearchTopResponse
{
    /**
     * @var array
     */
    private $results = [];

    /**
     * SearchTopResponse constructor.
     * @param $data
     */
    public function __construct($data)
    {
        foreach ($data->searches as $search) {
            $this->results[] = new SearchResult($search);
        }
    }

    /**
     * @return array
     */
    public function getResults()
    {
        return $this->results;
    }
}
