<?php

namespace App\Services\Admin;

use App\Builders\ExcelDocumentBuilder;
use App\Builders\Interfaces\DocumentBuilderInterface;
use App\Objects\CreateReportRequestObject;
use App\Order;
use App\Services\Admin\Interfaces\ExcelServiceInterface;
use App\Strategies\Excel\ExcelReportTypeStrategy;
use Carbon\Carbon;

class ExcelService implements ExcelServiceInterface //TODO top products by period, top clients by period, orders total sum by monthes, days
{
    /**
     * @var DocumentBuilderInterface
     */
    private $builder;
    /**
     * @var ExcelReportTypeStrategy
     */
    private $reportTypeStrategy;

    /**
     * ExcelService constructor.
     */
    public function __construct()
    {
        $this->builder = new ExcelDocumentBuilder();
        $this->reportTypeStrategy = new ExcelReportTypeStrategy();
    }

    /**
     * @param CreateReportRequestObject $requestObject
     * @return \App\Components\Documents\Document
     */
    public function getAllOrdersReportDocument(CreateReportRequestObject $requestObject)
    {
        $this->builder->createDocument($this->getAllOrdersReportName());

        $this->setOrdersReport($requestObject);

        $this->builder->saveDocument();

        return $this->builder->getDocument();
    }

    /**
     * @param CreateReportRequestObject $requestObject
     * @return \App\Components\Documents\Document
     */
    public function getOrdersStatsReportDocument(CreateReportRequestObject $requestObject)
    {
        $this->builder->createDocument($this->getAllOrdersReportName());

        $this->setOrdersStatsReport($requestObject);

        $this->builder->saveDocument();

        return $this->builder->getDocument();
    }

    /**
     * @return string
     */
    private function getAllOrdersReportName()
    {
        return 'all_orders_report' . Carbon::now()->format('Y_m_d');
    }

    /**
     * @param CreateReportRequestObject $requestObject
     */
    private function setOrdersReport(CreateReportRequestObject $requestObject)
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

        $this->builder->addRow(array_keys($orders->first()), 1);

        foreach ($orders as $key => $order) {
            $this->builder->addRow($order, $key + 2);
        }
    }

    /**
     * @param CreateReportRequestObject $requestObject
     */
    private function setOrdersStatsReport(CreateReportRequestObject $requestObject)
    {
        $orders = Order::query()
            ->where('created_at', '>=', $requestObject->getFromDate())
            ->where('created_at', '<=', $requestObject->getTillDate())
            ->get();

        $profitItems = $this->reportTypeStrategy
            ->getStrategy($requestObject->getType()->getValue())
            ->getOrdersStatsData($orders);

        $this->setOrdersStatsReportHead($requestObject);

        foreach ($profitItems as $key => $profitItem) {
            $this->builder->addRow([
                $profitItem->getName(),
                $profitItem->getProfit(),
                $profitItem->getAverage(),
                $profitItem->getTotal()
            ], $key + 2);
        }
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
