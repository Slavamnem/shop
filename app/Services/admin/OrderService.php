<?php

namespace App\Services\Admin;

use App\Client;
use App\DeliveryType;
use App\Enums\OrderStatusEnum;
use App\Order;
use App\OrderProduct;
use App\OrderStatus;
use App\PaymentType;
use App\Product;
use App\Services\Admin\Interfaces\OrderServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderService implements OrderServiceInterface
{
    /**
     * @var Request
     */
    private $request;

    /**
     * ProductServiceInterface constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
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
    public function createOrder() // refactor
    {
        $basket = resolve(BasketService::class)->getBasket();

        $client = $this->saveOrderClient();

        $order = $this->saveOrder($basket, $client);

        $this->saveOrderProducts($basket, $order);

        return $order;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function saveOrderClient(): \Illuminate\Database\Eloquent\Model
    {
        $client = Client::firstOrNew(["phone" => $this->request->input("phone")]);
        $client->fill($this->request->only($client->getFillable()));
        $client->save();

        return $client;
    }

    /**
     * @param $basket
     * @param $client
     * @return Order
     */
    public function saveOrder($basket, $client): Order
    {
        $order = new Order([
            "status_id"        => OrderStatusEnum::PAID,
            "sum"              => $basket->getSum(),
            "client_id"        => $client->id,
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
     * @param $basket
     * @param $order
     */
    public function saveOrderProducts($basket, $order): void
    {
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