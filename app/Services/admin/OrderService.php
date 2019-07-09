<?php

namespace App\Services\Admin;

use App\Client;
use App\Components\RestApi\NovaPoshta;
use App\DeliveryType;
use App\Enums\DeliveryTypesEnum;
use App\Enums\OrderStatusEnum;
use App\Order;
use App\OrderProduct;
use App\OrderStatus;
use App\PaymentType;
use App\Product;
use App\Services\Admin\Interfaces\OrderServiceInterface;
use App\Services\Admin\Interfaces\TableFilterDataInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderService implements OrderServiceInterface
{
    /**
     * @var Request
     */
    private $request;
    /**
     * @var
     */
    private $basketService;
    /**
     * @var
     */
    private $order;
    /**
     * @var
     */
    private $client;

    /**
     * OrderService constructor.
     * @param Request $request
     * @param BasketService $basketService
     */
    public function __construct(Request $request, BasketService $basketService)
    {
        $this->request = $request;
        $this->basketService = $basketService;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getFilteredOrders()
    {
        $specialFields = [
            "payment_type_id"  => "payment_type",
            "delivery_type_id" => "delivery_type",
        ];

        $query = Order::query();

        if (array_key_exists($this->request->input("field"), $specialFields)) {
            $query = $query->whereHas($specialFields[$this->request->input("field")], function($q){
                $q->where("name", "like", "%" . $this->request->input("value") . "%");
            });
        } else {
            $query = $query->where($this->request->input("field"),"like", "%" . $this->request->input("value") . "%");
        }

        $orders = $query->paginate(10);

        return $orders;
    }

    /**
     * @param $id
     * @return array
     */
    public function getData($id = null)
    {
        return array_merge($this->basketService->getBasketData(), [
            "order"          => $id? Order::find($id) : null,
            "statuses"       => OrderStatus::all(),
            "payment_types"  => PaymentType::all(),
            "delivery_types" => DeliveryType::all(),
            "url"            => env("DOMAIN_NAME") . "/" . $this->request->path(),
        ]);
    }

    public function createOrder()
    {
        $this->saveOrderClient();
        $this->saveOrder();
        $this->saveOrderProducts();
    }

    /**
     *
     */
    public function saveOrderClient()
    {
        $client = Client::firstOrNew(["phone" => $this->request->input("phone")]);
        $client->fill($this->request->only($client->getFillable()));
        $client->save();

        $basket = $this->basketService->getBasket();
        $basket->setClient($client);
        $this->client = $client;
    }

    public function saveOrder()
    {
        $basket = $this->basketService->getBasket();

        $order = new Order([
            "status_id"        => OrderStatusEnum::PAID,
            "sum"              => $this->basketService->getTotalSum(),
            "client_id"        => $this->client->id,
            "description"      => $this->request->input("description"),
            "payment_type_id"  => $this->request->input("payment_type"),
            "delivery_type_id" => $this->request->input("delivery_type"),
            "city"             => $basket->getCity()->name,
            "warehouse"        => $this->request->input("warehouse"),
            "basket_id"        => $basket->getBasket()->id
        ]);
        $order->save();

        $this->order = $order;
    }

    /**
     *
     */
    public function saveOrderProducts(): void
    {
        $basket = $this->basketService->getBasket();
        $orderProducts = [];

        foreach ($basket->getProducts() as $basketProduct) {
            $orderProduct = new OrderProduct();
            $orderProduct->order_id      = $this->order->id;
            $orderProduct->product_id    = $basketProduct->product->id;
            $orderProduct->quantity      = $basketProduct->getQuantity();
            $orderProduct->product_price = $basketProduct->getPrice();
            $orderProduct->sum           = $basketProduct->getTotalPrice();

            $orderProducts[] = $orderProduct;
        }

        $this->order->products()->saveMany($orderProducts);
    }

}
