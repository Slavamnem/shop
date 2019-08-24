<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Client;
use App\Components\Basket;
use App\Components\BasketProduct;
use App\Components\RestApi\NovaPoshta;
use App\DeliveryType;
use App\Enums\DeliveryTypesEnum;
use App\Enums\OrderStatusEnum;
use App\Enums\PaymentTypesEnum;
use App\Http\Middleware\SectionsAccess\OrdersAccessMiddleware;
use App\Http\Requests\Admin\CreateOrderRequest;
use App\Http\Requests\Admin\EditOrderRequest;
use App\Notifications\DefaultNotification;
use App\Notifications\NewOrderNotification;
use App\NpWarehouses;
use App\Order;
use App\OrderProduct;
use App\OrderStatus;
use App\PaymentType;
use App\Product;
use App\Services\Admin\BasketService;
use App\Services\Admin\Interfaces\NovaPoshtaServiceInterface;
use App\Services\Admin\OrderService;
use App\Services\NovaPoshtaService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
     * @var NovaPoshtaServiceInterface
     */
    private $novaPoshtaService;

    /**
     * OrderController constructor.
     * @param Request $request
     * @param OrderService $service
     * @param BasketService $basketService
     * @param NovaPoshtaServiceInterface $novaPoshtaService
     */
    public function __construct(Request $request, OrderService $service, BasketService $basketService, NovaPoshtaServiceInterface $novaPoshtaService)
    {
        $this->request = $request;
        $this->service = $service;
        $this->basketService = $basketService;
        $this->novaPoshtaService = $novaPoshtaService;
        View::share("activeMenuItem", self::MENU_ITEM_NAME);
        $this->middleware([OrdersAccessMiddleware::class]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dump(resolve(NovaPoshta::class)->getOrderPrice([
            "CitySender" => "8d5a980d-391c-11dd-90d9-001a92567626",
            "CityRecipient" => "db5c88e0-391c-11dd-90d9-001a92567626",
            "Weight" => 20,
            "ServiceType" => "WarehouseWarehouse",
            "Cost" => 3000,
            "CargoType" => "Cargo",
            "SeatsAmount" => 1
        ]));


        $orders = Order::query()->orderByDesc('created_at')->paginate(10);
        return view("admin.orders.index", compact('orders'));
    }

    /**
     * @param NovaPoshta $novaPoshta
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(NovaPoshta $novaPoshta)
    {
        //$this->basketService->clearBasket();

        $data = array_merge($this->service->getData(), [
            "cities"   => City::all(),
            "products" => Product::all(),
        ]);

        //dump($novaPoshta->getCities());

        return view("admin.orders.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateOrderRequest $request)
    {
        $this->service->createOrder();
        $this->service->getOrder()->notify(new NewOrderNotification($request->input("link")));
        $this->service->getOrder()->notify(new DefaultNotification());

        return redirect()->route("admin-orders-edit", ['id' => $this->service->getOrder()->id]);
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function filter()
    {
        $orders = $this->service->getFilteredOrders();

        return view("admin.orders.filtered_table", compact('orders'));
    }

    public function removeBasket()
    {
        $this->basketService->clearBasket();
        return view("admin.orders.basket", ['basketProducts' => []])->render();
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

    /**
     * @return string
     * @throws \Throwable
     */
    public function selectCity()
    {
        $this->basketService->selectCity();

        if ($this->request->input("deliveryType") == DeliveryTypesEnum::NOVA_POSHTA) {
            return $this->getCityWareHousesBlock();
        }
    }

    /**
     * @return string
     * @throws \Throwable
     */
    public function selectDeliveryType()
    {
        if ($this->request->input("deliveryType") == DeliveryTypesEnum::NOVA_POSHTA) {
            return $this->getCityWareHousesBlock();
        }
    }

    /**
     * @return false|null|string
     */
    public function getClientData()
    {
        $client = Client::where($this->request->input("field"), $this->request->input("value"))->first();
        return json_encode($client) ?? null;
    }

    /**
     * @return string
     * @throws \Throwable
     */
    private function getCityWareHousesBlock()
    {
        //$warehouses = $this->novaPoshtaService->getCityWareHouses($this->basketService->getBasketObject()->getCity());
        $warehouses = NpWarehouses::query()
            ->where('city_ref', $this->basketService->getBasketObject()->getCity()->ref)
            ->get();

        return view("admin.orders.warehouses", compact("warehouses"))->render();
    }

}
