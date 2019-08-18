<?php

namespace App\Services\Admin;

use App\Basket;
use App\Components\BasketObject;
use App\Components\Interfaces\BasketObjectInterface;
use App\Components\RestApi\NovaPoshta;
use App\DeliveryType;
use App\Enums\DeliveryTypesEnum;
use App\Order;
use App\OrderStatus;
use App\PaymentType;
use App\Product;
use App\Services\NovaPoshtaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BasketService
{
    /**
     * @var Request
     */
    private $request;
    /**
     * @var OrderPriceCalcService
     */
    private $priceCalcService;

    /**
     * BasketService constructor.
     * @param Request $request
     * @param OrderPriceCalcService $priceCalcService
     */
    public function __construct(Request $request, OrderPriceCalcService $priceCalcService)
    {
        $this->request = $request;
        $this->priceCalcService = $priceCalcService;
    }

    /**
     * @return BasketObjectInterface
     */
    public function getBasket()
    {
        if (Session::has("basketId")) {
            $basketObject = new BasketObject(Basket::findOrFail(Session::get("basketId"))); // TODO если нет баскета в бд страница не откроется
        } else {
            $basketDb = new Basket();
            $basketDb->save();
            Session::put("basketId", $basketDb->id);
            $basketObject = new BasketObject($basketDb);
        }

        return $basketObject;
    }

    /**
     * @param $productId
     */
    public function addBasketProduct($productId)
    {
        $this->getBasket()->addProduct(Product::find($productId));
    }

    /**
     * @return array
     */
    public function getBasketData()
    {
        $basketObject = $this->getBasket();

        return [
            "basketProducts" => $basketObject->getBasket()->products,
            "sum"            => $basketObject->getTotalPrice()
        ];
    }

    public function clearBasket()
    {
        Session::forget("basketId");
    }

    public function selectCity()
    {
        $this->getBasket()->setCity($this->request->input("cityRef"));
    }

    /**
     * @return int|mixed
     */
    public function getTotalOrderPrice()
    {
        $this->priceCalcService->setBasket($this->getBasket());

        return $this->priceCalcService->calcOrderPrice(
            $this->request->input("delivery_type"),
            $this->request->input("payment_type")
        );
    }
}
