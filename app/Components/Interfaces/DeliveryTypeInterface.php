<?php

namespace App\Components\Interfaces;

use App\Components\BasketObject;

interface DeliveryTypeInterface
{
    /**
     * @param BasketObject $basket
     * @return mixed
     */
    public function getExtraPrice(BasketObject $basket);
}