<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18.09.2019
 * Time: 0:33
 */

namespace App\Strategies\Interfaces;

use Illuminate\Support\Collection;

interface ExcelReportPeriodStrategyInterface
{
    /**
     * @param Collection $orders
     * @return array|Collection
     */
    public function getOrdersStatsData(Collection $orders);

    /**
     * @return string
     */
    public function getTypePeriodName();
}
