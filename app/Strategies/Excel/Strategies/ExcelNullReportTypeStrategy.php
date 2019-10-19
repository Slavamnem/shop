<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.10.2019
 * Time: 0:14
 */

namespace App\Strategies\Excel\Strategies;

use App\Strategies\Interfaces\ExcelReportStrategyInterface;
use Illuminate\Support\Collection;

class ExcelNullReportTypeStrategy implements ExcelReportStrategyInterface
{
    /**
     * @param Collection $orders
     * @return array
     */
    public function getOrdersStatsData(Collection $orders)
    {
        return collect();
    }

    /**
     * @return string
     */
    public function getTypePeriodName()
    {
        return "???";
    }
}
