<?php

namespace App\Http\Controllers\Api;

use App\Components\Helpers\ResponseHelper;
use App\Http\Resources\OrderResource;
use App\Http\Resources\UserResource;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOrders()
    {
        $data = OrderResource::collection(Order::all());

        return ResponseHelper::success($data);
    }

    /**
     * @param Order $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOrder(Order $order)
    {
        $data = new OrderResource($order);

        return ResponseHelper::success($data);
    }
}
