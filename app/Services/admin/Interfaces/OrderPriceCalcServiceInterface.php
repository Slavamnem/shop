<?php

namespace App\Services\Admin\Interfaces;

use App\Components\Interfaces\BasketObjectInterface;

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
     * @param BasketObjectInterface $basketObject
     * @return int|mixed
     */
    public function calcOrderPrice(BasketObjectInterface $basketObject);
}