<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.10.2019
 * Time: 0:14
 */

namespace App\Strategies\Excel\Strategies\PeriodType;

use App\Strategies\Interfaces\ExcelReportPeriodStrategyInterface;
use Illuminate\Support\Collection;

class ExcelNullReportTypePeriodStrategy implements ExcelReportPeriodStrategyInterface
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
