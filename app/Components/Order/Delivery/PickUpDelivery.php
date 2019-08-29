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

    /**
     * @return string
     * @throws \Throwable
     */
    public function getCityWareHousesBlock()
    {
        return view("admin.orders.warehouses", ['warehouses' => collect()])->render();
    }
}
