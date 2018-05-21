<?php

namespace Algolia\Response\Filter;

use Algolia\Response\Filter\Result\FilterNoResultResult;

class FilterNoResultsResponse
{
    /**
     * @var array
     */
    private $results = [];

    /**
     * FilterTopResponse constructor.
     * @param $data
     */
    public function __construct($data)
    {
        if (is_array($data->values)) {
            foreach ($data->values as $filter) {
                $this->results[] = new FilterNoResultResult($filter);
            }
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
