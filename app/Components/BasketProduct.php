<?php

namespace App\Components;

class BasketProduct
{
    /**
     * @var
     */
    private $product;
    /**
     * @var
     */
    private $quantity;

    /**
     * BasketProduct constructor.
     * @param $product
     */
    public function __construct($product)
    {
        $this->product = $product;
        $this->quantity = 1;
    }

    /**
     *
     */
    public function add()
    {
        $this->quantity++;
    }

    /**
     * @return mixed
     */
    public function getPrice() // TODO get price checking shares prices
    {
        // возможно передавать массив с ключами базовой цены и акционной
        return $this->product->base_price;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->product->name;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return float|int
     */
    public function getTotalPrice()
    {
        return $this->getPrice() * $this->getQuantity();
    }

    public function getProduct()
    {
        return $this->product;
    }
}