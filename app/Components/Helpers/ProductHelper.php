<?php

namespace App\Components\Helpers;

class ProductHelper
{
    /**
     * @param $basePrice
     * @param $discount
     * @return float|int
     */
    public static function getDiscountPrice($basePrice, $discount)
    {
        $basePrice -= $basePrice * ($discount / 100); //$price *= (100 - $productShare->discount) / 100;
        return $basePrice;
    }
}
