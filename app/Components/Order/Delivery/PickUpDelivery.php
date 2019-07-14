<?php

namespace App\Components\Order\Delivery;

use App\Components\Interfaces\BasketObjectInterface;
use App\Components\Interfaces\DeliveryTypeInterface;

class PickUpDelivery implements DeliveryTypeInterface
{
    /**
     * @param BasketObjectInterface $basket
     * @return mixed
     */
    public function getExtraPrice(BasketObjectInterface $basket)
    {
        return 0;
    }
}