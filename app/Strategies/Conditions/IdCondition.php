<?php

namespace App\Strategies\Conditions;

use App\Product;

class IdCondition
{
    /**
     * @return Product[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getValues()
    {
        return Product::all()->mapWithKeys(function($product){
            return [$product->id => $product->name . " (id: {$product->id})"];
        });
    }
}