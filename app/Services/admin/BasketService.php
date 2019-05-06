<?php

namespace App\Services\Admin;

use App\Components\Basket;
use App\DeliveryType;
use App\Enums\DeliveryTypesEnum;
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
     * @return Basket $basket
     */
    public function getBasket()
    {
        if (Session::has("basket")) {
            $basket = Session::get("basket");
        } else {
            $basket = new Basket();
        }

        return $basket;
    }

    /**
     * @param $productId
     */
    public function addBasketProduct($productId)
    {
        $basket = $this->getBasket();

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

    /**
     *
     */
    public function clearBasket()
    {
        Session::forget("basket");
    }

    public function selectCity() // TODO refactor
    {
        $basket = $this->getBasket();

        $basket->setCity($this->request->input("cityRef"));
        Session::put("basket", $basket);

//        if ($this->request->input("deliveryType") == DeliveryTypesEnum::NOVA_POSHTA) {
//            return $this->getWareHouses();
//        }
    }
}