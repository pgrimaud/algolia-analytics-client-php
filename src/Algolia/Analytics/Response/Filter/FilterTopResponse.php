<?php

namespace Algolia\Response\Filter;

use Algolia\Response\Filter\Result\FilterTopResult;

class FilterTopResponse
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
        if (is_array($data->attributes)) {
            foreach ($data->attributes as $filter) {
                $this->results[] = new FilterTopResult($filter);
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
