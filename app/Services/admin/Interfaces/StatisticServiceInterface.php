<?php

namespace App\Services\Admin\Interfaces;

interface StatisticServiceInterface
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getProductsList();
}
