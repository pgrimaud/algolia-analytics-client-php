<?php

namespace Algolia\Response\Filter;

class FilterResult
{
    /**
     * @var int
     */
    private $hit;

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
        $this->hit   = $data->hit;
        $this->count = $data->count;
    }

    /**
     * @return int
     */
    public function getHit()
    {
        return $this->hit;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }
}
