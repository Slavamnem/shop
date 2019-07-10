<?php

namespace App\Services\Admin;

use App\Components\BasketObject;
use App\Components\Interfaces\DeliveryTypeInterface;
use App\Components\Interfaces\PaymentTypeInterface;
use App\Enums\DeliveryTypesEnum;
use App\Enums\PaymentTypesEnum;
use App\Services\Admin\Interfaces\OrderPriceCalcServiceInterface;

class OrderPriceCalcService implements OrderPriceCalcServiceInterface
{
    /**
     * @var DeliveryTypeInterface
     */
    private $delivery;
    /**
     * @var PaymentTypeInterface
     */
    private $payment;

    public function __construct(){}

    /**
     * @param $deliveryType
     */
    public function setDelivery($deliveryType)
    {
        $this->delivery = DeliveryTypesEnum::getDelivery($deliveryType);
    }

    /**
     * @param $paymentType
     */
    public function setPayment($paymentType)
    {
        $this->payment = PaymentTypesEnum::getPayment($paymentType);
    }

    /**
     * @param BasketObject $basketObject
     * @return int|mixed
     */
    public function calcOrderPrice(BasketObject $basketObject)
    {
        return $basketObject->getTotalPrice() + $this->delivery->getExtraPrice($basketObject) + $this->payment->getExtraPrice($basketObject);
    }
}