<?php

namespace App\Components\Interfaces;

use App\Basket;
use App\Client;
use App\Product;

interface BasketObjectInterface
{
    /**
     * BasketObject constructor.
     * @param Basket|null $basket
     */
    public function __construct(Basket $basket = null);

    /**
     * @param Product $product
     */
    public function addProduct(Product $product);

    /**
     * @param Client $client
     */
    public function setClient(Client $client);

    /**
     * @return mixed
     */
    public function getClient();

    /**
     * @param $cityRef
     */
    public function setCity($cityRef);

    /**
     * @return mixed
     */
    public function getCity();

    /**
     * @return array
     */
    public function getProducts();

    /**
     * @return int
     */
    public function getBasketPrice();

    /**
     * @return int
     */
    public function getBasketWeight();

    /**
     * @return Basket|null
     */
    public function getBasket();
}