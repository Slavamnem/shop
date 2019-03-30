<?php

namespace App\Services\Admin;

use App\DeliveryType;
use App\Order;
use App\OrderStatus;
use App\PaymentType;
use App\Services\Admin\Interfaces\OrderServiceInterface;
use Illuminate\Http\Request;

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
}