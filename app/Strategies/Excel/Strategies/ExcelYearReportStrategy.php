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

class ExcelYearReportStrategy implements ExcelReportStrategyInterface
{
    /**
     * @param Collection $orders
     * @return array|Collection
     */
    public function getOrdersStatsData(Collection $orders)
    {
        $profitItems = collect();

        foreach (range(0, 12) as $itemKey) {
            $profitItems->put($itemKey, (new ProfitPeriodItemObject())
                ->setName(Carbon::create()->day(1)->month($itemKey + 1)->format("M"))
            );
        }

        foreach ($orders as $order) {
            $profitItems->get($order->created_at->month - 1)->addProfit($order->sum);
        }

        return $profitItems;
    }

    /**
     * @return string
     */
    public function getTypePeriodName()
    {
        return "Месяц";
    }
}
