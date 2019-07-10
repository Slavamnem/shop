<?php

namespace App\Services\Admin\Interfaces;

use App\Components\BasketObject;

interface OrderPriceCalcServiceInterface
{
    /**
     * @param $deliveryType
     */
    public function setDelivery($deliveryType);

    /**
     * @param $paymentType
     */
    public function setPayment($paymentType);

    /**
     * @param BasketObject $basketObject
     * @return int|mixed
     */
    public function calcOrderPrice(BasketObject $basketObject);
}