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

class AllOrdersReportStrategy extends AbstractReportTypeStrategy implements ExcelReportStrategyInterface
{
    /**
     * @param DocumentBuilderInterface $builder
     * @param CreateReportRequestObject $requestObject
     * @return mixed
     */
    public function setReportData(DocumentBuilderInterface $builder, CreateReportRequestObject $requestObject)
    {
        $orders = Order::query()
            ->where('created_at', '>=', $requestObject->getFromDate())
            ->where('created_at', '<=', $requestObject->getTillDate())
            ->get()
            ->map(function($order) {
                return [
                    'Id заказа' => $order->id,
                    'Статус' => $order->status->name,
                    'Сумма' => $order->sum,
                    'Клиент' => $order->client->name,
                    'Описание' => $order->description,
                    'Тип оплаты' => $order->payment_type->name,
                    'Тип доставки' => $order->delivery_type->name,
                    'Город' => $order->city,
                    'Отделение' => $order->warehouse,
                    'Время создания' => $order->created_at,
                ];
            });

        if ($orders->isNotEmpty()) {
            $builder->addRow(array_keys($orders->first()), 1);
        }

        foreach ($orders as $key => $order) {
            $builder->addRow($order, $key + 2);
        }
    }

    /**
     * @return string
     */
    public function getReportName()
    {
        return 'all_orders_report' . Carbon::now()->format('Y_m_d');
    }

    /**
     * @param CreateReportRequestObject $requestObject
     */
    private function setOrdersStatsReportHead(CreateReportRequestObject $requestObject)
    {
        $this->builder->addRow([
            $this->reportTypeStrategy->getStrategy($requestObject->getType()->getValue())->getTypePeriodName(),
            'Прибыль',
            'Средний чек',
            'Количество заказов'
        ], 1);
    }
}
