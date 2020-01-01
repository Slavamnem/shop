<?php

namespace App\Strategies\Conditions;

use App\Product;
use App\Repositories\ProductsRepository;

class IdCondition
{
    /**
     * @var ProductsRepository
     */
    private $productsRepository;

    /**
     * IdCondition constructor.
     * @param ProductsRepository $productsRepository
     */
    public function __construct(ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    /**
     * @return Product[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getValues()
    {
        return $this->productsRepository->getAllProducts()->mapWithKeys(function($product){
            return [$product->id => $product->name . " (id: {$product->id})"];
        });
    }
}
