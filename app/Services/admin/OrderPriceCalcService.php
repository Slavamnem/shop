<?php

namespace App\Services\Admin;

use App\Components\Interfaces\BasketObjectInterface;
use App\Services\Admin\Interfaces\OrderPriceCalcServiceInterface;
use App\Strategies\Delivery\DeliveryStrategy;
use App\Strategies\Interfaces\StrategyInterface;
use App\Strategies\Payment\PaymentStrategy;

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

    /**
     * OrderPriceCalcService constructor.
     */
    public function __construct(){
        $this->deliveryStrategy = new DeliveryStrategy();
        $this->paymentStrategy = new PaymentStrategy();
    }

    /**
     * @param BasketObjectInterface $basketObject
     * @return $this
     */
    public function setBasket(BasketObjectInterface $basketObject)
    {
        $this->basketObject = $basketObject;
        return $this;
    }

    /**
     * @param int $deliveryType
     * @param int $paymentType
     * @return int|mixed
     */
    public function calcOrderPrice($deliveryType, $paymentType)
    {
        return $this->basketObject->getBasketPrice() +
            $this->deliveryStrategy->getStrategy($deliveryType)->getExtraPrice($this->basketObject) +
            $this->paymentStrategy->getStrategy($paymentType)->getExtraPrice($this->basketObject);
    }
}
