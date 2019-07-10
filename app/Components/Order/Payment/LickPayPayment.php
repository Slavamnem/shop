<?php

namespace App\Components\Order\Payment;

use App\Components\BasketObject;
use App\Components\Interfaces\PaymentTypeInterface;

class LickPayPayment implements PaymentTypeInterface
{
    /**
     * @param BasketObject $basket
     * @return int|mixed
     */
    public function getExtraPrice(BasketObject $basket)
    {
        return 0;
    }
}