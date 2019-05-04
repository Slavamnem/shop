<?php

namespace App\Services;

use App\Components\City;
use App\Components\RestApi\NovaPoshta;

class NovaPoshtaService
{
    /**
     * @var mixed
     */
    private $novaPoshta;

    /**
     * NovaPoshtaService constructor.
     */
    public function __construct()
    {
        $this->novaPoshta = resolve(NovaPoshta::class);
    }

    /**
     * @param City $city
     * @return string
     * @throws \Throwable
     */
    public function getCityWareHouses(City $city) // TODO refactor
    {
        $warehouses = resolve(NovaPoshta::class)->getWarehouses([
            "CityRef" => $city->getRef()
        ]);

        return $warehouses;
    }
}
