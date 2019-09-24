<?php

namespace App\Http\Controllers\Site;

use App\City;
use App\Client;
use App\Components\AppCenter;
use App\Components\Signals\Signal;
use App\Http\Requests\Admin\CreateOrderRequest;
use App\Notifications\DefaultNotification;
use App\Notifications\NewOrderNotification;
use App\Product;
use App\Services\Admin\Interfaces\BasketServiceInterface;
use App\Services\Admin\Interfaces\NovaPoshtaServiceInterface;
use App\Services\Admin\OrderService;
use App\Strategies\Delivery\DeliveryStrategy;
use App\Strategies\Interfaces\StrategyInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

class OrderController extends Controller
{
    /**
     * @var OrderService
     */
    private $service;
    /**
     * @var BasketServiceInterface
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
     * @var StrategyInterface
     */
    private $deliveryStrategy;

    /**
     * OrderController constructor.
     * @param Request $request
     * @param OrderService $service
     * @param BasketServiceInterface $basketService
     * @param NovaPoshtaServiceInterface $novaPoshtaService
     */
    public function __construct(Request $request, OrderService $service, BasketServiceInterface $basketService, NovaPoshtaServiceInterface $novaPoshtaService)
    {
        $this->request = $request;
        $this->service = $service;
        $this->basketService = $basketService;
        $this->novaPoshtaService = $novaPoshtaService;
        $this->deliveryStrategy = new DeliveryStrategy();
    }

    public function addBasketProduct()
    {
        $this->basketService->addBasketProduct($this->request->input("newProductId"));

        return view("site.order.basket", $this->basketService->getBasketData())->render();
    }

    /**
     * @return string
     * @throws \Throwable
     */
    public function changeQuantity()
    {
        $this->basketService->changeQuantity($this->request->input("productId"));

        App::make(AppCenter::class)->sendSignal(new Signal());

        return view("site.order.basket", $this->basketService->getBasketData())->render();
    }

    /**
     * @return string
     * @throws \Throwable
     */
    public function removeProduct()
    {
        $this->basketService->removeBasketProduct($this->request->input("productId"));

        return view("site.order.basket", $this->basketService->getBasketData())->render();
    }

    /**
     * @return string
     * @throws \Throwable
     */
    public function selectCity()
    {
        $this->basketService->selectCity();

        return $this->deliveryStrategy->getStrategy($this->request->input("deliveryType"))->getCityWareHousesBlock();
    }

    /**
     * @return string
     * @throws \Throwable
     */
    public function selectDeliveryType()
    {
        return $this->deliveryStrategy->getStrategy($this->request->input("deliveryType"))->getCityWareHousesBlock();
    }

    /**
     * @return false|string
     */
    public function getClientData()
    {
        return json_encode(Client::query()
            ->where($this->request->input("field"), $this->request->input("value"))
            ->first());
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function checkout()
    {
        $data = array_merge($this->service->getData(), [
            "cities"   => City::all(),
            "products" => Product::all(),
            'basket'   => view("site.order.short_basket", $this->basketService->getBasketData())
        ]);

        //dump($data['basket']);

        return view("site.order.checkout", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function createOrder(CreateOrderRequest $request)
    {
        $this->service->createOrder();
        $this->service->getOrder()->notify(new NewOrderNotification($request->input("link")));
        $this->service->getOrder()->notify(new DefaultNotification());

        return redirect()->route("main");
    }
}
