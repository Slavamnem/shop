<?php

namespace App\Services\Admin;

use App\Adapters\EntityGraphicResourceItemAdapter;
use App\Client;
use App\Components\Graphics\Graphic;
use App\Components\Graphics\MultipleBarDiagram;
use App\Components\Graphics\MultipleGraphicDiagram;
use App\Components\Graphics\Resources\VariationGraphicResource;
use App\Components\Graphics\Resources\TimeGraphicResource;
use App\Components\Graphics\SingleBarDiagram;
use App\Components\Graphics\SingleGraphicDiagram;
use App\Enums\GraphicSegregationTypesEnum;
use App\Enums\PaymentTypesEnum;
use App\Notification;
use App\Objects\GraphicDataObject;
use App\Order;
use App\Product;
use App\Services\Admin\Interfaces\StatisticServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class StatisticService implements StatisticServiceInterface
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
    public function getOrdersStatsGraphic() : Graphic
    {
        return (new MultipleGraphicDiagram())
            ->setTitle('Статистика продаж за год')
            ->addResource((new TimeGraphicResource())
                ->setSegregationType(GraphicSegregationTypesEnum::YEAR()->getValue())
                ->setResourceItems(
                    Order::thisYear()->get()->map(function($order) {
                        return new EntityGraphicResourceItemAdapter($order, null, function($order){
                            return $order->sum;
                        });
                    })
                )
            );
    }

    /**
     * @return Graphic
     */
    public function getNotificationsStatsGraphic() : Graphic
    {
        return (new MultipleGraphicDiagram())
            ->setTitle('Статистика уведомлений (Синий - новый заказ, красный - вход в админку)')
            ->addResource((new TimeGraphicResource())
                ->setSegregationType(GraphicSegregationTypesEnum::YEAR()->getValue())
                ->setResourceItems(
                    Notification::where('preview', 'Новый заказ!')->get()->map(function($notification) {
                        return new EntityGraphicResourceItemAdapter($notification, null, null);
                    })
                )
            )
            ->addResource((new TimeGraphicResource())
                ->setSegregationType(GraphicSegregationTypesEnum::YEAR()->getValue())
                ->setResourceItems(
                    Notification::where('preview', 'Вход в админ-панель')->get()->map(function($notification) {
                        return new EntityGraphicResourceItemAdapter($notification, null, null);
                    })
                )
            );
    }

    /**
     * @return Graphic
     */
    public function getOrdersStatsMonthGraphic() : Graphic
    {
        return (new SingleGraphicDiagram())
            ->setTitle('Статистика продаж за последний месяц')
            ->addResource((new TimeGraphicResource())
                ->setSegregationType(GraphicSegregationTypesEnum::MONTH()->getValue())
                ->setResourceItems(
                    Order::thisMonth()->get()->map(function($order) {
                        return new EntityGraphicResourceItemAdapter($order, null, function($order){
                            return $order->sum;
                        });
                    })
                )
            );
    }

    /**
     * @return Graphic
     */
    public function getOrdersPaymentTypesStatsGraphic() : Graphic
    {
        return (new MultipleBarDiagram())
            ->setTitle('За все время по типам оплаты (LiqPay и наличка)')
            ->addResource((new TimeGraphicResource())
                ->setSegregationType(GraphicSegregationTypesEnum::YEAR()->getValue())
                ->setResourceItems(Order::query()
                    ->where('payment_type_id', PaymentTypesEnum::LIQ_PAY()->getValue())
                    ->get()
                    ->map(function($order) {
                        return new EntityGraphicResourceItemAdapter($order, null, function($order){ return $order->sum; });
                    })
                )
            )
            ->addResource((new TimeGraphicResource())
                ->setSegregationType(GraphicSegregationTypesEnum::YEAR()->getValue())
                ->setResourceItems(Order::query()
                    ->where('payment_type_id', PaymentTypesEnum::CASH()->getValue())
                    ->get()
                    ->map(function($order) {
                        return new EntityGraphicResourceItemAdapter($order, null, function($order){ return $order->sum; });
                    })
                )
            );
    }
    // TODO в акции добавить в интерфейс общий методы добавления и получения детей чтобы было полное единообразия работы с компонентами
    /**
     * @return array
     */
    public function getTest()
    {
       // dump(1);
        return (new SingleBarDiagram())
            ->setTitle('Заказы за все время по часам')
            ->addResource((new TimeGraphicResource())
                ->setSegregationType(GraphicSegregationTypesEnum::DAY()->getValue())
                ->setResourceItems(
                    Order::query()
                        ->get()
                        ->map(function($order) { return new EntityGraphicResourceItemAdapter(
                            $order, null,
//                            function($order) {
//                                return lang("months." . $order->created_at->format('F'));
//                                //return Client::find($order->client_id)->name;
//                            },
                            function($order) {
                                return $order->sum;
                            });
                        })
                )
            )
            ->getGraphicData();
    }
    // TODO один лейбл приходит для мультибара с типом вариация
    // TODO

    /**
     * @return array
     */
    public function getTest2()
    {
        return (new MultipleBarDiagram())
            ->setTitle('Test diagram with orders!')
            ->addResource((new TimeGraphicResource())
                ->setResourceItems(
                    Order::query()
                        ->where('payment_type_id', PaymentTypesEnum::LIQ_PAY()->getValue())
                        ->get()
                        ->map(function($order){ return new EntityGraphicResourceItemAdapter($order); })//, PaymentTypesEnum::LIQ_PAY()->getName()); })
                )
            )
            ->addResource((new TimeGraphicResource())
                ->setResourceItems(
                    Order::query()
                        ->where('payment_type_id', PaymentTypesEnum::CASH()->getValue())
                        ->get()
                        ->map(function($order){ return new EntityGraphicResourceItemAdapter($order); })//, PaymentTypesEnum::CASH()->getName()); })
                )
            )
            ->getGraphicData();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getProductsList()
    {
        $products = Product::query()->with('orders')->get();

        $this->getProductsSales($products);

        $sortField = ($this->request->input('checked') == "true") ? 'profit' : 'quantity';

        return $products->sortByDesc($sortField);
    }

    /**
     * @param Collection $products
     * @return Collection
     */
    private function getProductsSales(Collection $products)
    {
        foreach ($products as $product) {
            $product->quantity = $product->orders->sum("quantity");
            $product->profit = $product->orders->sum("sum");
        }

        return $products;
    }










    /**
     * @param GraphicDataObject $dataObject
     * @return array
     */
    private function getGraphicData(GraphicDataObject $dataObject) //TODO deprecated
    {
        return [
            'title'  => $dataObject->getTitle(),
            'labels' => $dataObject->getLabels(),
            'values' => $dataObject->getValues(),
        ];
    }
}
