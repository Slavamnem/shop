<?php

namespace App\Strategies\Payment\Strategies;

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
