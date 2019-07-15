<?php

namespace App\Services\Admin\Interfaces;

interface StatisticServiceInterface
{
    /**
     * @param $products
     * @return mixed
     */
    public function getProductsSales($products);
}
