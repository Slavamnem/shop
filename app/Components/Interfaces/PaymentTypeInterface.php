<?php

namespace App\Components\Interfaces;

use App\Components\BasketObject;

interface PaymentTypeInterface
{
    /**
     * @param BasketObject $basket
     * @return mixed
     */
    public function getExtraPrice(BasketObject $basket);
}