<?php

namespace Algolia\Response\User;

use Algolia\Response\AbstractCountResponse;

class UserCountResponse extends AbstractCountResponse
{
    /**
     * UserCountResponse constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->count = $data->count;
        foreach ($data->dates as $date) {
            $this->dates[] = new UserDateResponse($date);
        }
    }
}
