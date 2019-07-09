<?php

namespace App\Components;

use App\Basket;
use App\BasketProduct;
use App\City;
use App\Client;
use App\Components\RestApi\NovaPoshta;
use App\Product;
use App\Services\Admin\BasketService;

class BasketObject
{
    /**
     * @var Basket|null
     */
    private $basket;
    /**
     * @var
     */
    //private $basketProducts;
    /**
     * @var
     */
    private $city;
    /**
     * @var Client
     */
    private $client;

    /**
     * BasketObject constructor.
     * @param Basket|null $basket
     */
    public function __construct(Basket $basket = null)
    {
        $this->basket = $basket;
    }

    /**
     * @param Product $product
     */
    public function addProduct(Product $product)
    {
        if ($this->hasProduct($product->id)) {
            BasketProduct::query()
                ->where("basket_id", $this->basket->id)
                ->where("product_id", $product->id)
                ->increment("quantity");
        } else {
            $this->basket->products()
                ->save(new BasketProduct([
                    'product_id' => $product->id,
                    'quantity'   => 1,
                    'price'      => $product->getPrice()
                ]));
        }
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client)
    {
        $this->basket->client_id = $client->id;
        $this->basket->save();
    }

    /**
     * @param $cityRef
     */
    public function setCity($cityRef) // TODO replace to order
    {
        $this->basket->setCity(City::where('ref', $cityRef)->first()->id);
        $this->basket->save();
    }

    /**
     * @return mixed
     */
    public function getCity()  // TODO replace to order
    {
        return $this->basket->city;
    }

    /**
     * @return array
     */
    public function getProducts()
    {
        return $this->basket->products;
    }

    /**
     * @return int
     */
    public function getTotalPrice()
    {
        $sum = 0;
        foreach ($this->getProducts() as $basketProduct) {
            $sum += $basketProduct->price * $basketProduct->quantity;
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
            if ($weightProperty = $basketProduct->product->properties()->where("name", "Вес")->first()) {
                $weight += (int)$weightProperty->pivot->value;
            }
        }

        return $weight;
    }

    /**
     * @return Basket|null
     */
    public function getBasket()
    {
        return $this->basket;
    }

    /**
     * @param $productId
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\HasMany|null|object
     */
    private function hasProduct($productId)
    {
        return $this->basket->products()->where("product_id", $productId)->first();
    }
}
