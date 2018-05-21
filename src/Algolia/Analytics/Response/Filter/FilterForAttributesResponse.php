<?php

namespace Algolia\Response\Filter;

use Algolia\Response\Filter\Result\FilterForAttributesResult;

class FilterForAttributesResponse
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
                $this->results[] = new FilterForAttributesResult($filter);
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
