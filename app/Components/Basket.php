<?php

namespace App\Components;

use App\Client;
use App\Components\RestApi\NovaPoshta;
use App\Product;
use App\Services\Admin\BasketService;

class Basket
{
    /**
     * @var
     */
    private $basketProducts;
    /**
     * @var
     */
    private $city;
    /**
     * @var Client
     */
    private $client;

    /**
     * Basket constructor.
     */
    public function __construct()
    {
        $this->basketProducts = [];
    }

    /**
     * @param Product $product
     */
    public function addProduct(Product $product)
    {
        if (array_key_exists($product->id, $this->basketProducts)) {
            $this->basketProducts[$product->id]->add();
        } else {
            $this->basketProducts[$product->id] = new BasketProduct($product);
        }
    }

    /**
     * @param $cityRef
     */
    public function setCity($cityRef)
    {
        $cities = resolve(NovaPoshta::class)->getCities(["Ref" => $cityRef]);

        $city = new City();
        $city->setName($cities[0]->DescriptionRu);
        $city->setRef($cities[0]->Ref);
        $city->setCityId($cities[0]->CityID);
        $city->setArea($cities[0]->Area);
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return array
     */
    public function getProducts()
    {
        return $this->basketProducts;
    }

    /**
     * @return int
     */
    public function getSum()
    {
        $sum = 0;
        foreach ($this->basketProducts as $basketProduct) {
            $sum += $basketProduct->getTotalPrice();
        }

        $sum += resolve(BasketService::class)->getNovaPoshtaDeliveryCost($sum)[0]->Cost;

        return $sum;
    }

    /**
     * @return int
     */
    public function getTotalWeight()
    {
        $weight = 0;

        foreach ($this->getProducts() as $basketProduct) {
            $weightProperty = $basketProduct->getProduct()->properties()->where("name", "Вес")->first();
            if ($weightProperty) {
                $weight += (int)$weightProperty->pivot->value;
            }
        }

        return $weight;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }
}
