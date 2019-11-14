<?php

namespace App\Strategies\Conditions;

use App\Product;

class IdCondition extends AbstractCondition
{
    /**
     * @return $this
     */
    protected function setValues()
    {
        $this->values = Product::all()->mapWithKeys(function($product){
            return [$product->id => $product->name . " (id: {$product->id})"];
        });

        return $this;
    }
}
