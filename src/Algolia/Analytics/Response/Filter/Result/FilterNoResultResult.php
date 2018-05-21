<?php

namespace Algolia\Response\Filter\Result;

class FilterNoResultResult
{
    /**
     * @var \StdClass
     */
    private $values;

    /**
     * @var int
     */
    private $count;

    /**
     * FilterResult constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->values = $data->values;
        $this->count  = $data->count;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @return \StdClass
     */
    public function getValues()
    {
        return $this->values;
    }
}
