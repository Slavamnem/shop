<?php

namespace App\Components\Order\Delivery;

use App\Components\BasketObject;
use App\Components\Interfaces\DeliveryTypeInterface;
use App\Services\NovaPoshtaService;

class NovaPoshtaDelivery implements DeliveryTypeInterface
{
    /**
     * @param BasketObject $basket
     * @return mixed
     */
    public function getExtraPrice(BasketObject $basket)
    {
        $novaPoshtaService = new NovaPoshtaService();

        return $novaPoshtaService->getDeliveryCost($basket);
    }
}