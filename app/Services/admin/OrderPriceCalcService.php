<?php

namespace App\Services\Admin;

use App\Components\Interfaces\BasketObjectInterface;
use App\Components\Interfaces\DeliveryTypeInterface;
use App\Components\Interfaces\PaymentTypeInterface;
use App\Enums\DeliveryTypesEnum;
use App\Enums\PaymentTypesEnum;
use App\Services\Admin\Interfaces\OrderPriceCalcServiceInterface;
use App\Strategies\DeliveryStrategy;
use App\Strategies\Interfaces\StrategyInterface;
use App\Strategies\PaymentStrategy;

class OrderPriceCalcService implements OrderPriceCalcServiceInterface
{
    /**
     * @var StrategyInterface
     */
    private $deliveryStrategy;
    /**
     * @var StrategyInterface
     */
    private $paymentStrategy;
    /**
     * @var BasketObjectInterface
     */
    private $basketObject;

    public function __construct(){
        $this->deliveryStrategy = new DeliveryStrategy();
        $this->paymentStrategy = new PaymentStrategy();
    }

    /**
     * @param BasketObjectInterface $basketObject
     */
    public function setBasket(BasketObjectInterface $basketObject)
    {
        $this->basketObject = $basketObject;
    }

    /**
     * @param $deliveryType
     * @param $paymentType
     * @return int|mixed
     */
    public function calcOrderPrice($deliveryType, $paymentType)
    {
        return $this->basketObject->getTotalPrice() +
            $this->deliveryStrategy->getStrategy($deliveryType)->getExtraPrice($this->basketObject) +
            $this->paymentStrategy->getStrategy($paymentType)->getExtraPrice($this->basketObject);
    }
}