<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.10.2019
 * Time: 0:11
 */

namespace App\Strategies\Excel;

use App\Enums\ReportPeriodTypesEnum;
use App\Enums\ReportTypesEnum;
use App\Strategies\Excel\Strategies\Types\AllOrdersReportStrategy;
use App\Strategies\Excel\Strategies\Types\ClientsStatsReportStrategy;
use App\Strategies\Excel\Strategies\Types\NullReportStrategy;
use App\Strategies\Excel\Strategies\Types\OrdersStatsReportStrategy;
use App\Strategies\Excel\Strategies\Types\ProductsStatsReportStrategy;
use App\Strategies\Excel\Strategies\Types\TopClientsReportStrategy;
use App\Strategies\Excel\Strategies\Types\TopProductsReportStrategy;
use App\Strategies\Interfaces\ExcelReportStrategyInterface;
use App\Strategies\Interfaces\StrategyInterface;
use Illuminate\Support\Collection;

class ExcelReportTypeStrategy implements StrategyInterface
{
    /**
     * @var Collection
     */
    private $strategies;

    public function __construct()
    {
        $this->loadStrategies();
    }

    public function loadStrategies()
    {
        $this->strategies = collect();
        $this->strategies->put(ReportTypesEnum::ALL_ORDERS, new AllOrdersReportStrategy());
        $this->strategies->put(ReportTypesEnum::ORDERS_STATS, new OrdersStatsReportStrategy());
        $this->strategies->put(ReportTypesEnum::TOP_PRODUCTS, new TopProductsReportStrategy());
        $this->strategies->put(ReportTypesEnum::PRODUCTS_STATS, new ProductsStatsReportStrategy());
        $this->strategies->put(ReportTypesEnum::TOP_CLIENTS, new TopClientsReportStrategy());
        $this->strategies->put(ReportTypesEnum::CLIENTS_STATS, new ClientsStatsReportStrategy());
    }

    /**
     * @param $type
     * @return ExcelReportStrategyInterface
     */
    public function getStrategy($type){
        if (!$this->strategies->has($type)) {
            return new NullReportStrategy();
        }

        return $this->strategies->get($type);
    }
}
