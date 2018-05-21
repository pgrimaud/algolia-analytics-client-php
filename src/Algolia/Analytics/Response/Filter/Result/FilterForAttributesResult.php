<?php

namespace Algolia\Response\Filter\Result;

class FilterForAttributesResult
{
    /**
     * @var string
     */
    private $attribute;

    /**
     * @var string
     */
    private $operator;

    /**
     * @var string
     */
    private $value;

    /**
     * @var int
     */
    private $count;

    /**
     * FilterForAttributesResult constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->attribute = $data->attribute;
        $this->operator  = $data->operator;
        $this->value     = $data->value;
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
     * @return string
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }
}
