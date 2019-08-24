<?php

namespace App\Components\Order\Delivery;

use App\Components\Interfaces\BasketObjectInterface;
use App\Components\Interfaces\DeliveryTypeInterface;
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
}