<?php

namespace App\Components\Order\Delivery;

use App\Components\Interfaces\BasketObjectInterface;
use App\Components\Interfaces\DeliveryTypeInterface;
use App\Services\NovaPoshtaService;

class NovaPoshtaDelivery implements DeliveryTypeInterface
{
    /**
     * @param BasketObjectInterface $basket
     * @return mixed
     */
    public function getExtraPrice(BasketObjectInterface $basket)
    {
        $novaPoshtaService = new NovaPoshtaService();

        return $novaPoshtaService->getDeliveryCost($basket);
    }
}