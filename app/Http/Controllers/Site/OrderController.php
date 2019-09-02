<?php

namespace App\Http\Controllers\Site;

use App\Services\Admin\Interfaces\BasketServiceInterface;
use App\Services\Admin\Interfaces\NovaPoshtaServiceInterface;
use App\Services\Admin\OrderService;
use App\Strategies\DeliveryStrategy;
use App\Strategies\Interfaces\StrategyInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
