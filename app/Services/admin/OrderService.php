<?php

namespace App\Services\Admin;

use App\Client;
use App\Components\RestApi\NovaPoshta;
use App\DeliveryType;
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
        return [
            "order"          => $id? Order::find($id) : null,
            "statuses"       => OrderStatus::all(),
            "payment_types"  => PaymentType::all(),
            "delivery_types" => DeliveryType::all(),
            "url"            => env("DOMAIN_NAME") . "/" . $this->request->path(),
        ];
    }

    /**
     * @return Order
     */
    public function createOrder()
    {
        $this->saveOrderClient();

        $order = $this->saveOrder();

        $this->saveOrderProducts($order);

        dd(resolve(NovaPoshta::class)->getOrderPrice([
            "CitySender" => "000655d8-4079-11de-b509-001d92f78698", //Odessa
            "CityRecipient" => $this->basketService->getBasket()->getCity()->getRef(),
            "Weight" => 20, // product weight property
            "ServiceType" => "WarehouseWarehouse",
            "Cost" => $this->basketService->getBasket()->getSum(),
            "CargoType" => "Cargo",
            "SeatsAmount" => 1
        ]));

        return $order;
    }

    /**
     *
     */
    public function saveOrderClient()
    {
        $client = Client::firstOrNew(["phone" => $this->request->input("phone")]);
        $client->fill($this->request->only($client->getFillable()));
        $client->save();

        $this->basketService->getBasket()->setClient($client);
    }

    /**
     * @return Order
     */
    public function saveOrder(): Order
    {
        $basket = $this->basketService->getBasket();

        $order = new Order([
            "status_id"        => OrderStatusEnum::PAID,
            "sum"              => $basket->getSum(),
            "client_id"        => $basket->getClient()->id,
            "description"      => $this->request->input("description"),
            "payment_type_id"  => $this->request->input("payment_type"),
            "delivery_type_id" => $this->request->input("delivery_type"),
            "city"             => $basket->getCity()->getName(),
            "warehouse"        => $this->request->input("warehouse"),
        ]);
        $order->save();

        return $order;
    }

    /**
     * @param $order
     */
    public function saveOrderProducts($order): void
    {
        $basket = $this->basketService->getBasket();
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
    }
}
