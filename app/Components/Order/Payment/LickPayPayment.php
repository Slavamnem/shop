<?php

namespace App\Components\Order\Payment;

use App\Components\Interfaces\BasketObjectInterface;
use App\Components\Interfaces\PaymentTypeInterface;

class LickPayPayment implements PaymentTypeInterface
{
    /**
     * @param BasketObjectInterface $basket
     * @return int|mixed
     */
    public function getExtraPrice(BasketObjectInterface $basket)
    {
        return 0;
    }
}
