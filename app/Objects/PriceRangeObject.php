<?php

namespace App\Objects;

class PriceRangeObject
{
    /**
     * @var
     */
    private $minPrice;
    /**
     * @var
     */
    private $maxPrice;

    /**
     * @return mixed
     */
    public function getMinPrice()
    {
        return $this->minPrice ?? 0;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setMinPrice($value)
    {
        $this->minPrice = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMaxPrice()
    {
        return $this->maxPrice ?? 10000000000;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setMaxPrice($value)
    {
        $this->maxPrice = $value;
        return $this;
    }
}
