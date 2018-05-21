<?php

namespace Algolia\Response\Filter\Result;

class FilterTopResult
{
    /**
     * @var string
     */
    private $attribute;

    /**
     * @var int
     */
    private $count;

    /**
     * FilterTopResult constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->attribute = $data->attribute;
        $this->count     = $data->count;
    }

    /**
     * @return string
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }
}
