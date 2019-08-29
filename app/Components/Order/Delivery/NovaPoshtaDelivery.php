<?php

namespace App\Components\Order\Delivery;

use App\Components\Interfaces\BasketObjectInterface;
use App\Components\Interfaces\DeliveryTypeInterface;
use App\NpWarehouses;
use App\Services\Admin\Interfaces\BasketServiceInterface;
use App\Services\Admin\Interfaces\NovaPoshtaServiceInterface;
use App\Services\NovaPoshtaService;

class NovaPoshtaDelivery implements DeliveryTypeInterface
{
    /**
     * @param BasketObjectInterface $basket
     * @return mixed
     */
    public function getExtraPrice(BasketObjectInterface $basket)
    {
        $novaPoshtaService = resolve(NovaPoshtaServiceInterface::class);

        return $novaPoshtaService->getDeliveryCost($basket);
    }

    /**
     * @return string
     * @throws \Throwable
     */
    public function getCityWareHousesBlock()
    {
        $warehouses = NpWarehouses::query()
            ->where(
                'city_ref',
                resolve(BasketServiceInterface::class)
                    ->getBasketObject()
                    ->getCity()
                    ->getRef())
            ->get();

        return view("admin.orders.warehouses", compact("warehouses"))->render();
    }
}
