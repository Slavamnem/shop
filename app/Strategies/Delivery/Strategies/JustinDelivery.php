<?php

namespace App\Strategies\Delivery\Strategies;

use App\Components\Interfaces\BasketObjectInterface;
use App\Components\Interfaces\DeliveryTypeInterface;
use App\NpWarehouses;

class JustinDelivery implements DeliveryTypeInterface
{
    /**
     * @param BasketObjectInterface $basket
     * @return mixed
     */
    public function getExtraPrice(BasketObjectInterface $basket)
    {
        return 10;
    }

    /**
     * @return string
     * @throws \Throwable
     */
    public function getCityWareHousesBlock()
    {
        $warehouses = collect([(new NpWarehouses(['name' => "Тестовое отделение Justin"]))]);

        return view("admin.orders.warehouses", compact("warehouses"))->render();
    }
}