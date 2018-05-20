<?php

namespace Algolia\Response\Search;

use Algolia\Response\Search\Result\SearchNoResultsResult;

class SearchNoResultsResponse
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
            $this->results[] = new SearchNoResultsResult($search);
        }
    }
}
