<?php

namespace Algolia\Response\Search;

use Algolia\Response\AbstractCountResponse;

class SearchCountResponse extends AbstractCountResponse
{
    /**
     * SearchCountResponse constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->count = $data->count;
        foreach ($data->dates as $date) {
            $this->dates[] = new SearchDateResponse($date);
        }
    }
}
