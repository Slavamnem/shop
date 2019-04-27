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

class StockController extends Controller
{
    const MENU_ITEM_NAME = "stock";

    /**
     * @var OrderService
     */
    private $service;

    /**
     * OrderController constructor.
     * @param OrderService $service
     */
    public function __construct(OrderService $service)
    {
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
        //dump("stock");
        $categories = Category::all();
        $products = Product::all();

        return view("admin.stock.index", compact('categories', 'products'));
    }

}
