<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.10.2019
 * Time: 0:14
 */

namespace App\Strategies\Excel\Strategies\PeriodType;

use App\Objects\ProfitPeriodItemObject;
use App\Strategies\Interfaces\ExcelReportPeriodStrategyInterface;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ExcelYearReportPeriodStrategy implements ExcelReportPeriodStrategyInterface
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

    public function getProductsStatsData($products)
    {

    }

    /**
     * @return string
     */
    public function getTypePeriodName()
    {
        return "Месяц";
    }
}
