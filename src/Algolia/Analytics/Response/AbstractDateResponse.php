<?php

namespace Algolia\Response;

abstract class AbstractDateResponse
{
    /**
     * @var int
     */
    private $count;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * AbstractDateResponse constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->count = $data->count;
        $this->date  = new \DateTime($data->date);
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }
}
