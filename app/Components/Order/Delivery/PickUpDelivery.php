<?php

namespace App\Components\Order\Delivery;

use App\Components\BasketObject;
use App\Components\Interfaces\DeliveryTypeInterface;

class PickUpDelivery implements DeliveryTypeInterface
{
    /**
     * @param BasketObject $basket
     * @return mixed
     */
    public function getExtraPrice(BasketObject $basket)
    {
        return 0;
    }
}