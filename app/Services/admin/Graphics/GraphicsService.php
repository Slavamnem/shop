<?php

namespace App\Services\Admin\Graphics;

use App\Client;
use App\Components\Graphics\Interfaces\Graphic;
use App\Components\Graphics\MultipleBarDiagram;
use App\Components\Graphics\MultipleGraphicDiagram;
use App\Components\Graphics\PieDiagram;
use App\Components\Graphics\Resources\MonthGraphicResource;
use App\Components\Graphics\Resources\VariationGraphicResource;
use App\Components\Graphics\Resources\YearGraphicResource;
use App\Components\Graphics\SingleBarDiagram;
use App\Components\Graphics\SingleGraphicDiagram;
use App\Enums\PaymentTypesEnum;
use App\Notification;
use App\Order;
use App\Services\Admin\Interfaces\GraphicsServiceInterface;
use Illuminate\Http\Request;

/**
 * Описание постороения графиков
 *
 * Есть классы типов графиков (interface Graphic): круговая диаграмма, классический график, столбцовая диаграмма -
 * их задача получить данные от ресурсов и передать фронту в нужном виде
 *
 * Есть классы ресурсов для графиков (interface GraphicResource) (по времени: годовой, месячный и тд) и вариационный
 * различаются по типу разбиения элементов
 * Все ресурсы строят свою сетку (временные ее предварительно нулями заполняют чтобы дырок не было и в конце не сортируют сетку)
 *
 * Есть элементы ресурсов (interface GraphicResourceItem), это любые модели eloquent поддерживающие трейт GraphicResourceItemTrait и имплементирующие GraphicResourceItem
 * Их сетят в ресурсы, задают анонимные функции для определения веса элемента и его ключа для формирования сетки
 *
 * У каждого графика может быть сколько угодно ресурсов - это как несколько функций на координатной плоскости
 * или несколько столбцов по каждому ключу разбиения
 *
 * Class StatisticService
 * @package App\Services\Admin
 */
class GraphicsService implements GraphicsServiceInterface
{
    /**
     * @var Request
     */
    private $request;

    /**
     * StatisticService constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return Graphic
     */
    public function getOrdersPaymentTypesStatsPieGraphic() : Graphic //TODO вынести отдельно от статистики заказов и клиентов в сервис графиков
    {
        return (new PieDiagram())
            ->setTitle('За все время по типам оплаты')
            ->addResource((new VariationGraphicResource())
                ->setResourceItems(Order::query()->get())
                ->setResourceItemsLabelDistributorClosure(function($order){
                    //return (int)($order->sum / 1000) * 1000 . " до " . ((int)($order->sum / 1000) * 1000 + 1000);
                    return PaymentTypesEnum::getValueById($order->payment_type_id);
                    //return Client::find($order->client_id)->name;
                })
                ->setResourceItemsValueQualifierClosure(function($order){ return $order->sum; })
                ->buildResourceGrid()
            );
    }

    /**
     * @return Graphic
     */
    public function getOrdersStatsGraphic() : Graphic
    {
        return (new MultipleGraphicDiagram())
            ->setTitle('Статистика продаж за год')
            ->addResource((new YearGraphicResource())
                ->setResourceItems(Order::thisYear()->get())
                ->setResourceItemsValueQualifierClosure(function ($order) { return $order->sum; })
                ->buildResourceGrid()
            );
    }

    /**
     * @return Graphic
     */
    public function getNotificationsStatsGraphic() : Graphic
    {
        return (new MultipleGraphicDiagram())
            ->setTitle('Статистика уведомлений (Синий - новый заказ, красный - вход в админку)')
            ->addResource((new YearGraphicResource())
                ->setResourceItems(Notification::where('preview', 'Новый заказ!')->get())
                ->buildResourceGrid()
            )
            ->addResource((new YearGraphicResource())
                ->setResourceItems(Notification::where('preview', 'Вход в админ-панель')->get())
                ->buildResourceGrid()
            );
    }

    /**
     * @return Graphic
     */
    public function getOrdersStatsMonthGraphic() : Graphic
    {
        return (new SingleGraphicDiagram())
            ->setTitle('Статистика продаж за последний месяц')
            ->addResource((new MonthGraphicResource())
                ->setResourceItems(Order::thisMonth()->get())
                ->setResourceItemsValueQualifierClosure(function($order){ return $order->sum; })
                ->buildResourceGrid()
            );
    }

    /**
     * @return Graphic
     */
    public function getOrdersPaymentTypesStatsGraphic() : Graphic
    {
        return (new MultipleBarDiagram())
            ->setTitle('За все время по типам оплаты (LiqPay и наличка)')
            ->addResource((new YearGraphicResource())
                ->setResourceItems(Order::query()->where('payment_type_id', PaymentTypesEnum::LIQ_PAY()->getValue())->get())
                ->setResourceItemsValueQualifierClosure(function($order){ return $order->sum; })
                ->buildResourceGrid()
            )
            ->addResource((new YearGraphicResource())
                ->setResourceItems(Order::query()->where('payment_type_id', PaymentTypesEnum::CASH()->getValue())->get())
                ->setResourceItemsValueQualifierClosure(function($order){ return $order->sum; })
                ->buildResourceGrid()
            );
    }
    // TODO в акции добавить в интерфейс общий методы добавления и получения детей чтобы было полное единообразия работы с компонентами
    /**
     * @return array
     */
    public function getTest()
    {
        return (new SingleBarDiagram())
            ->setTitle('Заказы за все время по часам')
            ->addResource((new VariationGraphicResource())
                ->setResourceItems(Order::query()->get())
                ->setResourceItemsLabelDistributorClosure(function($order) { return Client::find($order->client_id)->name; })
                ->setResourceItemsValueQualifierClosure(function($order) { return $order->sum; })
                ->buildResourceGrid()
            )
            ->getGraphicData();
    }
}
