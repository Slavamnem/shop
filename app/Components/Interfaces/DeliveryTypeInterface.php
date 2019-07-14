<?php

namespace App\Components\Interfaces;

interface DeliveryTypeInterface
{
    /**
     * @param BasketObjectInterface $basket
     * @return mixed
     */
    public function getExtraPrice(BasketObjectInterface $basket);
}