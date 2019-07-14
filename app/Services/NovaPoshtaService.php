<?php

namespace App\Services;

use App\City;
use App\Components\Interfaces\BasketObjectInterface;
use App\Components\RestApi\NovaPoshta;
use App\Services\Admin\Interfaces\NovaPoshtaServiceInterface;

class NovaPoshtaService implements NovaPoshtaServiceInterface
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
    public function getCityWareHouses(City $city)
    {
        $warehouses = resolve(NovaPoshta::class)->getWarehouses([
            "CityRef" => $city->ref
        ]);

        return $warehouses;
    }

    /**
     * @param BasketObjectInterface $basketObject
     * @return mixed
     */
    public function getDeliveryCost(BasketObjectInterface $basketObject)
    {
        return resolve(NovaPoshta::class)->getOrderPrice([
            "CitySender"    => env('NOVA_POSHTA_CITY_SENDER'), //Odessa
            "CityRecipient" => $basketObject->getCity()->ref,
            "Weight"        => $basketObject->getBasketWeight(),
            "ServiceType"   => "WarehouseWarehouse",
            "Cost"          => $basketObject->getTotalPrice(),
            "CargoType"     => "Cargo",
            "SeatsAmount"   => 1
        ])[0]->Cost;
    }
}
