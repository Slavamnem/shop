<?php

namespace App\Http\Controllers\Admin;

use App\Components\Basket;
use App\Components\BasketProduct;
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
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class OrderController extends Controller
{
    const MENU_ITEM_NAME = "orders";

    /**
     * @var OrderService
     */
    private $service;
    /**
     * @var
     */
    private $request;

    /**
     * OrderController constructor.
     * @param Request $request
     * @param OrderService $service
     */
    public function __construct(Request $request, OrderService $service)
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

        return view("admin.orders.index", compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view("admin.orders.create", compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order();

        $order->fill($request->only($order->getFillable()));
        $order->save();

        return redirect()->route("admin-orders-edit", ['id' => $order->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->service->getData($id);

        return view("admin.orders.show", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->service->getData($id);

        return view("admin.orders.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditOrderRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditOrderRequest $request, $id)
    {
        $order = Order::find($id);

        $order->fill($request->only($order->getFillable()));

        $order->save();

        return redirect()->route("admin-orders-edit", ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = Order::find($id);
        $group->delete();

        return redirect()->route("admin-orders");
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function pushToTelegram(Request $request, $id)
    {
        $order = Order::find($id);
        $order->notify(new NewOrderNotification($request->input("link")));
    }

    public function addBasketProduct()
    {
        if (Session::has("basket")) {
            $basket = Session::get("basket");
        } else {
            $basket = new Basket();
        }

        $basket->addProduct(Product::find($this->request->newProductId));
        Session::put("basket", $basket);


        $basketProducts = $basket->getProducts();
        $sum = $basket->getSum();

        return view("admin.orders.basket", compact("basketProducts", "sum"))->render();
    }
}
