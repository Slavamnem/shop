<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\Components\Basket;
use App\Components\BasketProduct;
use App\Components\RestApi\NovaPoshta;
use App\DeliveryType;
use App\Enums\DeliveryTypesEnum;
use App\Enums\OrderStatusEnum;
use App\Enums\PaymentTypesEnum;
use App\Http\Requests\Admin\EditOrderRequest;
use App\Mail\MailSender;
use App\Notifications\NewOrderNotification;
use App\Order;
use App\OrderProduct;
use App\OrderStatus;
use App\PaymentType;
use App\Product;
use App\Services\Admin\BasketService;
use App\Services\Admin\OrderService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
     * @var BasketService
     */
    private $basketService;
    /**
     * @var
     */
    private $request;

    /**
     * OrderController constructor.
     * @param Request $request
     * @param OrderService $service
     * @param BasketService $basketService
     */
    public function __construct(Request $request, OrderService $service, BasketService $basketService)
    {
        $this->request = $request;
        $this->service = $service;
        $this->basketService = $basketService;
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
    public function create() // TODO refactor
    {
        Session::forget("basket");
        $products = Product::all();
        $deliveryTypes = DeliveryTypesEnum::getValues();
        $paymentTypes = PaymentTypesEnum::getValues();

        $novaPoshta = new NovaPoshta();
        $cities = $novaPoshta->getCities([
            "Language" => "ru"
        ]);
        //dump($cities);

        return view("admin.orders.create", compact('products', 'deliveryTypes', 'paymentTypes', 'cities'));
    }

    public function selectCity() // TODO refactor
    {
        if (Session::has("basket")) {
            $basket = Session::get("basket");
        } else {
            $basket = new Basket();
        }

        $basket->setCity($this->request->input("cityRef"));
        Session::put("basket", $basket);

        if ($this->request->input("deliveryType") == DeliveryTypesEnum::NOVA_POSHTA) {
            return $this->getWareHouses();
        }
    }


    public function selectDeliveryType() // TODO refactor
    {
        if ($this->request->input("deliveryType") == DeliveryTypesEnum::NOVA_POSHTA) {
            return $this->getWareHouses();
        }
    }

    public function getWareHouses() // TODO refactor
    {
        $basket = Session::get("basket");

        $novaPoshta = new NovaPoshta();
        $warehouses = $novaPoshta->getWarehouses([
            "Language" => "ru",
            "CityRef" => $basket->getCity()->getRef()
        ]);

        return view("admin.orders.warehouses", compact("warehouses"))->render();
        //return implode("<br>", (collect($warehouses)->pluck("DescriptionRu"))->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) // TODO refactor
    {
        $basket = Session::get("basket");

        // Client
        $client = Client::firstOrNew(["phone" => $request->input("phone")]);
        $client->fill($request->only($client->getFillable()));
        $client->save();
        //

        // Order
        $order = new Order([
            "status_id"        => OrderStatusEnum::PAID,
            "sum"              => $basket->getSum(),
            "client_id"        => $client->id,
            "description"      => $request->input("description"),
            "payment_type_id"  => $request->input("payment_type"),
            "delivery_type_id" => $request->input("delivery_type"),
            "city"             => $basket->getCity()->getName(),
            "warehouse"        => $request->input("warehouse"),
        ]);

        $order->save(); //$order->fill($request->only($order->getFillable()));
        //

        // OrderProducts
        $orderProducts = [];
        foreach ($basket->getProducts() as $basketProduct) {
            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $basketProduct->getProduct()->id;
            $orderProduct->quantity = $basketProduct->getQuantity();
            $orderProduct->product_price = $basketProduct->getPrice();
            $orderProduct->sum = $basketProduct->getTotalPrice();

            $orderProducts[] = $orderProduct;
        }
        $order->products()->saveMany($orderProducts);
        /////////////////////////////////////////////////////////////////

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
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
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

    /**
     * @return string
     * @throws \Throwable
     */
    public function addBasketProduct()
    {
        $this->basketService->addBasketProduct($this->request->input("newProductId"));
        $data = $this->basketService->getBasketData();

        return view("admin.orders.basket", $data)->render();
    }
}
