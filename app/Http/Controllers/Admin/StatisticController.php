<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Client;
use App\DeliveryType;
use App\Enums\PaymentTypesEnum;
use App\Http\Requests\Admin\EditOrderRequest;
use App\Mail\MailSender;
use App\Notifications\NewOrderNotification;
use App\Order;
use App\OrderStatus;
use App\PaymentType;
use App\Product;
use App\Services\Admin\Interfaces\StatisticServiceInterface;
use App\Services\Admin\OrderService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class StatisticController extends Controller
{
    const MENU_ITEM_NAME = "stats";

    /**
     * @var Request
     */
    private $request;
    /**
     * @var
     */
    private $service;

    /**
     * StatisticController constructor.
     * @param Request $request
     * @param StatisticServiceInterface $service
     */
    public function __construct(Request $request, StatisticServiceInterface $service)
    {
        $this->request = $request;
        $this->service = $service;
        View::share("activeMenuItem", self::MENU_ITEM_NAME);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();

        $profit[0] = $profit[1] = range(1, 12);

        foreach ($orders as $order) {
            if ($order->payment_type_id == PaymentTypesEnum::LIQ_PAY) {
                $profit[0][$order->created_at->month - 1] += $order->sum;
            } elseif ($order->payment_type_id == PaymentTypesEnum::CASH) {
                $profit[1][$order->created_at->month - 1] += $order->sum;
            }
        }

        $data = [
            "values" => $profit,
            'labels' => [
                "Январь", "Февраль", "Март", "Апрель",
                "Май", "Июнь", "Июль", "Август",
                "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"
            ]
        ];

        //dump($data);

        $categories = Category::all();

        //dump(date("m"));

        return view("admin.stats.index", compact('categories'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getTopProducts()
    {
        $products = Product::query()->with('orders')->get();

        $this->service->getProductsSales($products);

        $products = $products->sortByDesc('quantity');

        return view("admin.stats.top_products", compact('products'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getProductsList()
    {
        $products = Product::query()->with('orders')->get();

        $this->service->getProductsSales($products);

        $sortField = ($this->request->input('checked') == "true") ? 'profit' : 'quantity';
        $products = $products->sortByDesc($sortField);

        return view("admin.stats.products_list", compact('products'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getTopClients()
    {
        $clients = Client::query()->with('orders')->get();

        return view("admin.stats.top_clients", compact('clients'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOrdersStats() // TODO move to stats service
    {
        $orders = Order::all();

        $profit = range(1, 12); // TODO change, fill wrong data at start
        foreach ($orders as $order) {
            $profit[$order->created_at->month - 1] += $order->sum;
        }

        $data = [
            "profit" => $profit,
            'labels' => [
                "Январь", "Февраль", "Март", "Апрель",
                "Май", "Июнь", "Июль", "Август",
                "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"
            ]
        ];

        return response()->json($data);
    }

    public function getOrdersStatsMonth()
    {
        $orders = Order::thisMonth()->get();

        $profit = range(1, 30); // TODO change, fill wrong data at start
        foreach ($orders as $order) {
            $profit[$order->created_at->day - 1] += $order->sum;
        }

        $data = [
            "profit" => $profit,
            'labels' => range(1, 30)
        ];

        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOrdersPaymentTypesStats()
    {
        $orders = Order::all();

        $profit[0] = range(1, 12);
        $profit[1] = range(1, 12);

        foreach ($orders as $order) {
            if ($order->payment_type_id == PaymentTypesEnum::LIQ_PAY) {
                $profit[0][$order->created_at->month - 1] += $order->sum;
            } elseif ($order->payment_type_id == PaymentTypesEnum::CASH) {
                $profit[1][$order->created_at->month - 1] += $order->sum;
            }
        }

        $data = [
            "values" => $profit,
            'labels' => [
                "Январь", "Февраль", "Март", "Апрель",
                "Май", "Июнь", "Июль", "Август",
                "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"
            ]
        ];

        return response()->json($data);
    }
}
