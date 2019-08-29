<?php

namespace App\Components\Interfaces;

interface DeliveryTypeInterface
{
    /**
     * @param BasketObjectInterface $basket
     * @return mixed
     */
    public function getExtraPrice(BasketObjectInterface $basket);

    /**
     * @return string
     * @throws \Throwable
     */
    public function getCityWareHousesBlock();
}
