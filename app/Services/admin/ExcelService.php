<?php

namespace App\Services\Admin;

use App\Builders\ExcelDocumentBuilder;
use App\Builders\Interfaces\DocumentBuilderInterface;
use App\Order;
use App\Services\Admin\Interfaces\ExcelServiceInterface;
use Carbon\Carbon;

class ExcelService implements ExcelServiceInterface //TODO top products by period, top clients by period, orders total sum by monthes, days
{
    /**
     * @var DocumentBuilderInterface
     */
    private $builder;

    /**
     * ExcelService constructor.
     */
    public function __construct()
    {
        $this->builder = new ExcelDocumentBuilder();
    }

    /**
     * @return \App\Components\Documents\Document
     */
    public function getAllOrdersReportDocument() //TODO request object with from_date, till_date
    {
        $this->builder->createDocument($this->getAllOrdersReportName());

        $this->setOrdersReport();

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

    private function setOrdersReport()
    {
        $orders = Order::all()->map(function($order) {
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
}
