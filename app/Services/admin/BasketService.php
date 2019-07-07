<?php

namespace App\Services\Admin;

use App\Basket;
use App\Components\BasketObject;
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
     * ProductServiceInterface constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return BasketObject
     */
    public function getBasket()
    {
        if (Session::has("basketId")) {
            $basket = new BasketObject(Basket::findOrFail(Session::get("basketId"))); // TODO если нет баскета в бд страница не откроется
        } else {
            $basketDb = new Basket();
            $basketDb->save();
            Session::put("basketId", $basketDb->id);
            $basket = new BasketObject($basketDb);
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

    /**
     *
     */
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
    public function getTotalSum() //TODO сделать классы типов доставки и у каждого метод с наценкой на общую стоимость, итого = цена + наценка типа доставки
    { // TODO обавить в таблицу заказов айди корзины
        $totalSum = $this->getBasket()->getTotalPrice();

        if ($this->request->input("delivery_type") == DeliveryTypesEnum::NOVA_POSHTA) {
            $novaPoshtaService = new NovaPoshtaService();
            $totalSum += $novaPoshtaService->getDeliveryCost($this->getBasket());
        }

        return $totalSum;
    }
}
