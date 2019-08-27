<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\DeliveryType;
use App\Http\Middleware\SectionsAccess\StockAccessMiddleware;
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
        $this->middleware([StockAccessMiddleware::class]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view("admin.stock.index", compact('categories'));
    }

    public function changeQuantity()
    {
        if ($this->request->has("productId") and $this->request->has("quantity")) {
            Product::query()
                ->where("id", $this->request->input("productId"))
                ->update(['quantity' => $this->request->input("quantity")]);
        }
    }
}
