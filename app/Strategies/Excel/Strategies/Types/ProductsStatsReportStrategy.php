<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.10.2019
 * Time: 0:14
 */

namespace App\Strategies\Excel\Strategies\Types;

use App\Builders\Interfaces\DocumentBuilderInterface;
use App\Objects\CreateReportRequestObject;
use App\Order;
use App\Strategies\Interfaces\ExcelReportStrategyInterface;
use Carbon\Carbon;

class ProductsStatsReportStrategy extends AbstractReportTypeStrategy implements ExcelReportStrategyInterface
{
    /**
     * @param DocumentBuilderInterface $builder
     * @param CreateReportRequestObject $requestObject
     * @return mixed
     */
    public function setReportData(DocumentBuilderInterface $builder, CreateReportRequestObject $requestObject)
    {
        $this->initialize($builder, $requestObject);
    }

    /**
     * @return string
     */
    public function getReportName()
    {
        return 'products_stats_report' . Carbon::now()->format('Y_m_d');
    }

    private function setProductsStatsReportHead()
    {
//        $this->builder->addRow([
//            $this->reportPeriodTypeStrategy->getStrategy($this->requestObject->getPeriodType()->getValue())->getTypePeriodName(),
//            'Прибыль',
//            'Средний чек',
//            'Количество заказов'
//        ], 1);
    }
}
