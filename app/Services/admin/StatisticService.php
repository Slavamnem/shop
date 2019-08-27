<?php

namespace App\Services\Admin;

use App\Enums\PaymentTypesEnum;
use App\Order;
use App\Product;
use App\Services\Admin\Interfaces\StatisticServiceInterface;
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
        $orders = Order::all();

        $profit = array_init(0, 12); // TODO change, fill wrong data at start

        foreach ($orders as $order) {
            $profit[$order->created_at->month - 1] += $order->sum;
        }

        return [
            "profit" => $profit,
            'labels' => lang('months')
        ];
    }

    /**
     * @return array
     */
    public function getOrdersStatsMonth()
    {
        $orders = Order::thisMonth()->get();

        $profit = array_init(0, 31);
        foreach ($orders as $order) {
            $profit[$order->created_at->day - 1] += $order->sum;
        }

        return [
            "profit" => $profit,
            'labels' => range(1, 31)
        ];
    }

    /**
     * @return array
     */
    public function getOrdersPaymentTypesStats()
    {
        $orders = Order::all();

        $profit[0] = array_init(0, 12);
        $profit[1] = array_init(0, 12);

        foreach ($orders as $order) {
            if ($order->payment_type_id == PaymentTypesEnum::LIQ_PAY) {
                $profit[0][$order->created_at->month - 1] += $order->sum;
            } elseif ($order->payment_type_id == PaymentTypesEnum::CASH) {
                $profit[1][$order->created_at->month - 1] += $order->sum;
            }
        }

        return [
            "values" => $profit,
            'labels' => lang('months')
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
