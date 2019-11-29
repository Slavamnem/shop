<?php

namespace App\Strategies\Conditions;

use App\Product;

class IdCondition extends AbstractCondition
{
    /**
     * @param null $type
     * @return $this|mixed
     */
    public function getValues($type = null)
    {
        if (empty($this->values)) {
            $this->values = Product::all()->mapWithKeys(function ($product) {
                return [$product->id => $product->name . " (id: {$product->id})"];
            });
        }

        return $this->values;
    }
}
