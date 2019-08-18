<?php

namespace App\Services\Admin\Interfaces;

use App\Components\Interfaces\BasketObjectInterface;

interface OrderPriceCalcServiceInterface
{
    /**
     * @param BasketObjectInterface $basketObject
     */
    public function setBasket(BasketObjectInterface $basketObject);

    /**
     * @param $deliveryType
     * @param $paymentType
     * @return int|mixed
     */
    public function calcOrderPrice($deliveryType, $paymentType);
}