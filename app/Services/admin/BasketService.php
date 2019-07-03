<?php

namespace App\Services\Admin;

use App\Components\Basket;
use App\Components\RestApi\NovaPoshta;
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
            "sum"            => $basket->getTotalPrice()
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

    /**
     * @return mixed
     */
    public function getNovaPoshtaDeliveryCost()
    {
        return resolve(NovaPoshta::class)->getOrderPrice([
            "CitySender" => "000655d8-4079-11de-b509-001d92f78698", //Odessa //TODO refactor
            "CityRecipient" => $this->getBasket()->getCity()->getRef(),
            "Weight" => $this->getBasket()->getBasketWeight(),
            "ServiceType" => "WarehouseWarehouse",
            "Cost" => $this->getBasket()->getTotalPrice(),
            "CargoType" => "Cargo",
            "SeatsAmount" => 1
        ])[0]->Cost;
    }

    /**
     * @return int|mixed
     */
    public function getTotalSum()
    {
        $totalSum = $this->getBasket()->getTotalPrice();

        if ($this->request->input("delivery_type") == DeliveryTypesEnum::NOVA_POSHTA) {
            $totalSum += $this->getNovaPoshtaDeliveryCost();
        }

        return $totalSum;
    }
}
