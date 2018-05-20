<?php

namespace Algolia\Response\Filter;

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
                $this->results[] = new FilterResult($filter);
            }
        }
    }
}
