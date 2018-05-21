<?php

namespace Algolia\Response\Hit;

class HitTopResponse
{
    /**
     * @var array
     */
    private $results = [];

    /**
     * HitTopResponse constructor.
     * @param $data
     */
    public function __construct($data)
    {
        foreach ($data->hits as $hit) {
            $this->results[] = new HitResult($hit);
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
