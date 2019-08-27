<?php

namespace App\Services\Admin\Interfaces;

interface StatisticServiceInterface
{
    /**
     * @return array
     */
    public function getOrdersStats();

    /**
     * @return array
     */
    public function getOrdersStatsMonth();

    /**
     * @return array
     */
    public function getOrdersPaymentTypesStats();

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getProductsList();
}
