<?php

namespace Algolia\Response;

abstract class AbstractCountResponse
{
    /**
     * @var int
     */
    protected $count;

    /**
     * @var array
     */
    protected $dates;

    /**
     * @return array
     */
    public function getDates()
    {
        return $this->dates;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }
}
