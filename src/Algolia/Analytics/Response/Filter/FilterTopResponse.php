<?php

namespace Algolia\Response\Filter;

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
                $this->results[] = new FilterResult($filter);
            }
        }
    }
}
