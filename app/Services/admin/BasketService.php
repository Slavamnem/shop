<?php

namespace App\Services\Admin;

use App\Components\Basket;
use App\DeliveryType;
use App\Order;
use App\OrderStatus;
use App\PaymentType;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BasketService
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
     * @param $productId
     */
    public function addBasketProduct($productId)
    {
        if (Session::has("basket")) {
            $basket = Session::get("basket");
        } else {
            $basket = new Basket();
        }

        $basket->addProduct(Product::find($productId));
        Session::put("basket", $basket);
    }

    /**
     * @return array
     */
    public function getBasketData()
    {
        $basket = Session::get("basket");

        return [
            "basketProducts" => $basket->getProducts(),
            "sum"            => $basket->getSum()
        ];
    }
}