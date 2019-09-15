<?php

namespace App\Components;

use App\Basket;
use App\BasketProduct;
use App\City;
use App\Client;
use App\Components\Interfaces\BasketObjectInterface;
use App\Enums\ProductPropertiesEnum;
use App\Product;
use App\Services\Admin\Interfaces\ProductServiceInterface;
use Illuminate\Support\Collection;

class BasketObject implements BasketObjectInterface
{
    /**
     * @var Basket|null
     */
    private $basket;
    /**
     * @var
     */
    //private $basketProducts;
    /**
     * @var City
     */
    private $city;
    /**
     * @var Client
     */
    private $client;
    /**
     * @var ProductServiceInterface
     */
    private $productService;

    /**
     * BasketObject constructor.
     * @param Basket|null $basket
     */
    public function __construct(Basket $basket = null)
    {
        $this->basket = $basket;
        $this->productService = resolve(ProductServiceInterface::class);
    }

    /**
     * @param Product $product
     */
    public function addProduct(Product $product)
    {
        if ($this->hasProduct($product->getId())) {
            $this->changeQuantity($product, "increment");
//            BasketProduct::query()
//                ->where("basket_id", $this->basket->id)
//                ->where("product_id", $product->getId())
//                ->increment("quantity");
        } else {
            $this->basket->products()
                ->save((new BasketProduct())
                    ->setProduct($product->getId())
                    ->setPrice($this->productService->getPrice($product))
                    ->setQuantity(1)
                );
        }
    }

    /**
     * @param Product $product
     * @param $action
     */
    public function changeQuantity(Product $product, $action)
    {
        $basketProductQuery = BasketProduct::query()
            ->where("basket_id", $this->basket->id)
            ->where("product_id", $product->getId());

        $newQuantity = $basketProductQuery->first()->getQuantity() + (($action == "increment") ? 1 : -1);

        if (!$newQuantity) {
            $this->removeProduct($product);
        } elseif ($newQuantity > $product->getQuantity()) {
            //
        } else {
            $basketProductQuery->update(['quantity' => $newQuantity]);
        }
    }

    /**
     * @param Product $product
     */
    public function removeProduct(Product $product)
    {
        BasketProduct::query()
            ->where("basket_id", $this->basket->id)
            ->where("product_id", $product->getId())
            ->delete();
    }

    /**
     * @param Client $client
     * @return $this
     */
    public function setClient(Client $client)
    {
        $this->basket->setClient($client->getId())->save();
        $this->client = $client;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param $cityRef
     */
    public function setCity($cityRef) // TODO replace to order
    {
        $this->basket->setCity(City::where('ref', $cityRef)->first()->getId())->save();
    }

    /**
     * @return mixed
     */
    public function getCity()  // TODO replace to order
    {
        return $this->basket->city;
    }

    /**
     * @return Collection
     */
    public function getProducts()
    {
        return $this->basket->products;
    }

    /**
     * @return int
     */
    public function getBasketPrice()
    {
        $sum = 0;
        foreach ($this->getProducts() as $basketProduct) {
            $sum += $basketProduct->getTotalPrice();
        }

        return $sum;
    }

    /**
     * @return int
     */
    public function getBasketWeight()
    {
        $weight = 0;

        foreach ($this->getProducts() as $basketProduct) {
            //TODO fix
            if ($weightProperty = $basketProduct->product->properties()->where("name", ProductPropertiesEnum::NEW_WEIGHT()->getValue())->first()) {
                $weight += (int)$weightProperty->pivot->value;
            }
        }

        return $weight;
    }

    /**
     * @return Basket|null
     */
    public function getBasket()
    {
        return $this->basket;
    }

    /**
     * @param $productId
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\HasMany|null|object
     */
    private function hasProduct($productId)
    {
        return $this->basket->products()->where("product_id", $productId)->first();
    }
}
