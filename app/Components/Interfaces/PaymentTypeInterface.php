<?php

namespace App\Components\Interfaces;

interface PaymentTypeInterface
{
    /**
     * @param BasketObjectInterface $basket
     * @return mixed
     */
    public function getExtraPrice(BasketObjectInterface $basket);
}