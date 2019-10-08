<?php

namespace App\Services;

use App\City;
use App\Components\Interfaces\BasketObjectInterface;
use App\Components\Interfaces\NovaPoshtaInterface;
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
     * @param NovaPoshtaInterface $novaPoshta
     */
    public function __construct(NovaPoshtaInterface $novaPoshta)
    {
        $this->novaPoshta = $novaPoshta;
    }

    /**
     * @return mixed
     */
    public function getCities()
    {
        return $this->novaPoshta->getCities();
    }

    /**
     * @return mixed
     */
    public function getWareHouses()
    {
        return $this->novaPoshta->getWarehouses();
    }

    /**
     * @param City $city
     * @return mixed|string
     */
    public function getCityWareHouses(City $city)
    {
        $warehouses = $this->novaPoshta->getWarehouses([
            "CityRef" => $city->ref
        ]);

        return $warehouses;
    }

    /**
     * @param BasketObjectInterface $basketObject
     * @return mixed
     */
    public function getDeliveryCost(BasketObjectInterface $basketObject) //TODO перестал отвечать
    {
//        dd(@$this->novaPoshta->getOrderPrice([
//            "CitySender"    => env('NOVA_POSHTA_CITY_SENDER'), //Odessa
//            "CityRecipient" => $basketObject->getCity()->ref,
//            "Weight"        => $basketObject->getBasketWeight(),
//            "ServiceType"   => "WarehouseWarehouse",
//            "Cost"          => $basketObject->getBasketPrice(),
//            "CargoType"     => "Cargo",
//            "SeatsAmount"   => 1
//        ]));
        return @$this->novaPoshta->getOrderPrice([
            "CitySender"    => env('NOVA_POSHTA_CITY_SENDER'), //Odessa
            "CityRecipient" => $basketObject->getCity()->ref,
            "Weight"        => $basketObject->getBasketWeight(),
            "ServiceType"   => "WarehouseWarehouse",
            "Cost"          => $basketObject->getBasketPrice(),
            "CargoType"     => "Cargo",
            "SeatsAmount"   => 1
        ])[0]->Cost;
    }
}
