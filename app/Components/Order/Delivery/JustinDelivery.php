<?php

namespace App\Components\Order\Delivery;

use App\Components\BasketObject;
use App\Components\Interfaces\DeliveryTypeInterface;

class JustinDelivery implements DeliveryTypeInterface
{
    /**
     * @param BasketObject $basket
     * @return mixed
     */
    public function getExtraPrice(BasketObject $basket)
    {
        return 10;
    }
}