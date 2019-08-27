<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Client;
use App\DeliveryType;
use App\Enums\PaymentTypesEnum;
use App\Http\Middleware\SectionsAccess\StatsAccessMiddleware;
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
     * @var StatisticServiceInterface
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
        $this->middleware([StatsAccessMiddleware::class]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.stats.index");
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getTopProducts()
    {
        $products = $this->service->getProductsList();

        return view("admin.stats.top_products", compact('products'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getProductsList()
    {
        $products = $this->service->getProductsList();

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
    public function getOrdersStats()
    {
        return response()->json($this->service->getOrdersStats());
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOrdersStatsMonth()
    {
        return response()->json($this->service->getOrdersStatsMonth());
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOrdersPaymentTypesStats()
    {
        return response()->json($this->service->getOrdersPaymentTypesStats());
    }
}
