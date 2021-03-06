<?php

namespace App\Strategies\Payment;

use App\Components\Interfaces\PaymentTypeInterface;
use App\Enums\PaymentTypesEnum;
use App\Strategies\Interfaces\StrategyInterface;
use App\Strategies\Payment\Strategies\CashOnDeliveryPayment;
use App\Strategies\Payment\Strategies\CashPayment;
use App\Strategies\Payment\Strategies\LickPayPayment;
use App\Strategies\Payment\Strategies\NullPayment;
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
        $this->strategies->put(PaymentTypesEnum::LIQ_PAY, new LickPayPayment());
        $this->strategies->put(PaymentTypesEnum::CASH, new CashPayment());
        $this->strategies->put(PaymentTypesEnum::CASH_ON_DELIVERY, new CashOnDeliveryPayment());
    }

    /**
     * @param $type
     * @return PaymentTypeInterface
     */
    public function getStrategy($type){
        if (!$this->strategies->has($type)) {
            return new NullPayment();
        }

        return $this->strategies->get($type);
    }
}
