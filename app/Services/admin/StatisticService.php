<?php

namespace App\Services\Admin;

use App\Enums\PaymentTypesEnum;
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
     * @return array
     */
    public function getOrdersStats()
    {
        $graphicDataObject = (new GraphicDataObject())
            ->setTitle('Динамика продаж за год')
            ->createSkeleton(lang('months'));

        foreach (Order::all() as $order) {
            $graphicDataObject->incrementItem(lang("months." . $order->created_at->format('F')), $order->sum);
        }

        return $this->getGraphicData($graphicDataObject);
    }

    /**
     * @param GraphicDataObject $dataObject
     * @return array
     */
    private function getGraphicData(GraphicDataObject $dataObject) //TODO adapter for user_actions that will have getTitle(), getLabels(), getValues()
    {
        return [
            'title'  => $dataObject->getTitle(),
            'labels' => $dataObject->getLabels(),
            'values' => $dataObject->getValues(),
        ];
    }

    /**
     * @return array
     */
    public function getOrdersStatsMonth()
    {
        $graphicDataObject = (new GraphicDataObject())
            ->setTitle('Динамика продаж за месяц')
            ->createSkeleton(range(1, 31));

        foreach (Order::thisMonth()->get() as $order) {
            $graphicDataObject->incrementItem($order->created_at->day - 1, $order->sum);
        }

        return $this->getGraphicData($graphicDataObject);
    }

    /**
     * @return array
     */
    public function getOrdersPaymentTypesStats() //TODO refactor
    {
        $orders = Order::all();

        $profit[0] = array_init(0, 12);
        $profit[1] = array_init(0, 12);

        foreach ($orders as $order) {
            if ($order->payment_type_id == PaymentTypesEnum::LIQ_PAY()->getValue()) {
                $profit[0][$order->created_at->month - 1] += $order->sum;
            } elseif ($order->payment_type_id == PaymentTypesEnum::CASH()->getValue()) {
                $profit[1][$order->created_at->month - 1] += $order->sum;
            }
        }

        return [
            "values" => $profit,
            'labels' => array_values(lang('months'))
        ];
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
}
