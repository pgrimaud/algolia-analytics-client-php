<?php

namespace Algolia\Response\User;

use Algolia\Response\AbstractDateResponse;

class UserDateResponse extends AbstractDateResponse
{
    /**
     * UserDateResponse constructor.
     * @param $data
     */
    public function __construct($data)
    {
        parent::__construct($data);
    }
}
