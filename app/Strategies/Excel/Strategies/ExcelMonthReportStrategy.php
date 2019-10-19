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
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ExcelMonthReportStrategy implements ExcelReportStrategyInterface
{
    /**
     * @param Collection $orders
     * @return array|Collection
     */
    public function getOrdersStatsData(Collection $orders)
    {
        $profitItems = collect();

        foreach (range(0, 30) as $itemKey) {
            $profitItems->put($itemKey, (new ProfitPeriodItemObject())
                ->setName($itemKey + 1)
            );
        }

        foreach ($orders as $order) {
            $profitItems->get($order->created_at->format('d') - 1)->addProfit($order->sum);
        }

        return $profitItems;
    }

    /**
     * @return string
     */
    public function getTypePeriodName()
    {
        return "День";
    }
}
