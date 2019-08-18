<?php

namespace App\Strategies;

use App\Components\Order\Delivery\JustinDelivery;
use App\Components\Order\Delivery\NovaPoshtaDelivery;
use App\Components\Order\Delivery\PickUpDelivery;
use App\Components\Order\Payment\CashOnDeliveryPayment;
use App\Components\Order\Payment\CashPayment;
use App\Components\Order\Payment\LickPayPayment;
use App\Strategies\Interfaces\StrategyInterface;
use Illuminate\Support\Collection;

class PaymentStrategy implements StrategyInterface
{
    /**
     * @var Collection
     */
    private $strategies;

    public function __construct()
    {
        $this->loadStrategies();
    }

    public function loadStrategies()
    {
        $this->strategies = collect();
        $this->strategies->put(1, new LickPayPayment());
        $this->strategies->put(2, new CashPayment());
        $this->strategies->put(3, new CashOnDeliveryPayment());
    }

    /**
     * @param $type
     * @return mixed
     */
    public function getStrategy($type){
        return $this->strategies->get($type);
    }
}