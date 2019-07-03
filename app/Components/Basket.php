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
        $this->basketProducts = collect();
    }

    /**
     * @param Product $product
     */
    public function addProduct(Product $product)
    {
        if ($this->basketProducts->has($product->id)) {
            $this->basketProducts->get($product->id)->add();
        } else {
            $this->basketProducts->put($product->id, new BasketProduct($product));
        }
    }

    /**
     * @param $cityRef
     */
    public function setCity($cityRef) // TODO replace to order
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
    public function getCity()  // TODO replace to order
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
    public function getTotalPrice()
    {
        $sum = 0;
        foreach ($this->basketProducts as $basketProduct) {
            $sum += $basketProduct->getTotalPrice();
        }

        return $sum;
    }

    /**
     * @return int
     */
    public function getBasketWeight()
    {
        $weight = 0;

        foreach ($this->getProducts() as $basketProduct) {
            //TODO refactor
            if ($weightProperty = $basketProduct->getProduct()->properties()->where("name", "Вес")->first()) {
                $weight += (int)$weightProperty->pivot->value;
            }
        }

        return $weight;
    }

//    /**
//     * @param Client $client
//     */
//    public function setClient(Client $client)
//    {
//        $this->client = $client;
//    }
//
//    /**
//     * @return Client
//     */
//    public function getClient()
//    {
//        return $this->client;
//    }
}
