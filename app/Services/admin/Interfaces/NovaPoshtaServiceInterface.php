<?php

namespace App\Services\Admin\Interfaces;

use App\City;
use App\Components\Interfaces\BasketObjectInterface;

interface NovaPoshtaServiceInterface
{
    /**
     * @param City $city
     * @return string
     * @throws \Throwable
     */
    public function getCityWareHouses(City $city);

    /**
     * @param BasketObjectInterface $basketObject
     * @return mixed
     */
    public function getDeliveryCost(BasketObjectInterface $basketObject);
}