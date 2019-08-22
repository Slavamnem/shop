<?php

namespace App\Services\Admin;

use App\Client;
use App\Components\BasketObject;
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
     * @var BasketService
     */
    private $basketService;
    /**
     * @var BasketObject
     */
    private $basketObject;
    /**
     * @var Order
     */
    private $order;
    /**
     * @var Client
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

    public function saveOrderClient()
    {
        $client = Client::query()->firstOrNew(["phone" => $this->request->input("phone")]);
        $client->fill($this->request->only($client->getFillable()));
        $client->save();

        $this->basketObject = $this->basketService->getBasketObject()->setClient($client);
    }

    public function saveOrder()
    {
        $this->order = (new Order())
            ->setStatus(OrderStatusEnum::PAID)
            ->setSum($this->basketService->getTotalPrice())
            ->setClient($this->basketObject->getClient()->id)
            ->setDescription($this->request->input("description"))
            ->setDeliveryType($this->request->input("delivery_type"))
            ->setPaymentType($this->request->input("payment_type"))
            ->setCity($this->basketObject->getCity()->name)
            ->setWarehouse($this->request->input("warehouse"))
            ->setBasket($this->basketObject->getBasket()->getId());

        $this->order->save();
    }

    public function saveOrderProducts(): void
    {
        $orderProducts = [];

        foreach ($this->basketObject->getProducts() as $basketProduct) {
            array_push($orderProducts, ((new OrderProduct())
                ->setOrder($this->order->getId())
                ->setProduct($basketProduct->product->id)
                ->setQuantity($basketProduct->getQuantity())
                ->setPrice($basketProduct->getPrice())
                ->setSum($basketProduct->getTotalPrice())
            ));
        }

        $this->order->products()->saveMany($orderProducts);
    }
}
