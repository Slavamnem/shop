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
use App\Repositories\ProductsRepository;
use App\Services\Admin\Interfaces\BasketServiceInterface;
use App\Services\NovaPoshtaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BasketService implements BasketServiceInterface
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
     * @var ProductsRepository
     */
    private $productsRepository;

    /**
     * BasketService constructor.
     * @param Request $request
     * @param OrderPriceCalcService $priceCalcService
     * @param ProductsRepository $productsRepository
     */
    public function __construct(Request $request, OrderPriceCalcService $priceCalcService, ProductsRepository $productsRepository)
    {
        $this->request = $request;
        $this->priceCalcService = $priceCalcService;
        $this->productsRepository = $productsRepository;
    }

    /**
     * @return BasketObjectInterface
     */
    public function getBasketObject()
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
        $this->getBasketObject()->addProduct($this->productsRepository->getProductById($productId));
    }

    /**
     * @param $productId
     */
    public function changeQuantity($productId)
    {
        $this->getBasketObject()->changeQuantity(
            $this->productsRepository->getProductById($productId),
            $this->request->input('action')
        );
    }

    /**
     * @param $productId
     */
    public function removeBasketProduct($productId)
    {
        $this->getBasketObject()->removeProduct($this->productsRepository->getProductById($productId));
    }

    /**
     * @return array
     */
    public function getBasketData() // TODO refactor
    {
        return [
            "basketProducts" => $this->getBasketObject()->getBasket()->products, //TODO method getProducts
            "sum"            => $this->getBasketObject()->getBasketPrice()
        ];
    }

    public function clearBasket()
    {
        Session::forget("basketId");
    }

    public function selectCity()
    {
        $this->getBasketObject()->setCity($this->request->input("cityRef"));
    }

    /**
     * @return int|mixed
     */
    public function getTotalPrice()
    {
        return $this->priceCalcService
            ->setBasket($this->getBasketObject())
            ->calcOrderPrice(
                $this->request->input("delivery_type"),
                $this->request->input("payment_type")
            );
    }
}
