<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\DeliveryType;
use App\Http\Requests\Admin\EditOrderRequest;
use App\Mail\MailSender;
use App\Notifications\NewOrderNotification;
use App\Order;
use App\OrderStatus;
use App\PaymentType;
use App\Product;
use App\Services\Admin\OrderService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
     * StockController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        View::share("activeMenuItem", self::MENU_ITEM_NAME);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $orders = Order::all();
//        foreach ($orders as $order){
//            dump($order->created_at->month);
//        }
        $categories = Category::all();

        return view("admin.stats.index", compact('categories'));
    }

    public function getOrdersStats()
    {
        $orders = Order::all();

        $profit = range(1, 12);
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
}
