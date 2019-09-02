<?php

namespace App\Services\Admin\Interfaces;

use App\Components\Interfaces\BasketObjectInterface;

interface BasketServiceInterface
{
    /**
     * @return BasketObjectInterface
     */
    public function getBasketObject();

    /**
     * @param $productId
     */
    public function addBasketProduct($productId);

    /**
     * @param $productId
     */
    public function changeQuantity($productId);

    /**
     * @param $productId
     */
    public function removeBasketProduct($productId);

    /**
     * @return array
     */
    public function getBasketData();

    public function clearBasket();

    public function selectCity();

    /**
     * @return int|mixed
     */
    public function getTotalPrice();
}
