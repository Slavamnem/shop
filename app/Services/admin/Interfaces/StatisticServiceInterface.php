<?php

namespace App\Services\Admin\Interfaces;

use Illuminate\Support\Collection;

interface StatisticServiceInterface
{
    /**
     * @param Collection $products
     * @return mixed
     */
    public function getProductsSales(Collection $products);
}
