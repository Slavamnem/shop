<?php

namespace App\Components;

use App\Components\RestApi\NovaPoshta;
use App\Product;

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

        return $sum;
    }
}
