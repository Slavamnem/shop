<?php

namespace App\Services\Admin;

use App\Services\Admin\Interfaces\StatisticServiceInterface;
use Illuminate\Support\Facades\DB;

class StatisticService implements StatisticServiceInterface
{
    /**
     * @param $products
     * @return mixed
     */
    public function getProductsSales($products)
    {
        foreach ($products as $product) {
            $product->quantity = $product->orders->sum("quantity");
            $product->profit = $product->orders->sum("sum");
        }

        return $products;
    }
}