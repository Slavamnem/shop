<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.10.2019
 * Time: 0:14
 */

namespace App\Strategies\Excel\Strategies;

use App\Objects\ProfitPeriodItemObject;
use App\Strategies\Interfaces\ExcelReportStrategyInterface;
use Illuminate\Support\Collection;

class ExcelDayReportStrategy implements ExcelReportStrategyInterface
{
    /**
     * @param Collection $orders
     * @return array|Collection
     */
    public function getOrdersStatsData(Collection $orders)
    {
        $profitItems = collect();

        foreach (range(0, 24) as $itemKey) {
            $profitItems->put($itemKey, (new ProfitPeriodItemObject())
                ->setName($itemKey . " hours")
            );
        }

        foreach ($orders as $order) {
            $profitItems->get($order->created_at->hour)->addProfit($order->sum);
        }

        return $profitItems;
    }

    /**
     * @return string
     */
    public function getTypePeriodName()
    {
        return "Час";
    }
}
