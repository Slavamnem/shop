<?php

namespace App\Components;

use App\Product;

class Basket
{
    /**
     * @var
     */
    public $basketProducts;

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
