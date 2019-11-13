<?php

namespace App\Strategies\Conditions;

use App\Product;
use Illuminate\Support\Collection;

class IdCondition
{
    /**
     * @var Collection
     */
    private $values;
    /**
     * @var IdCondition
     */
    private static $instance;

    /**
     * @return IdCondition
     */
    public static function Instance()
    {
        if (!self::$instance) {
            self::$instance = (new self())->setValues();
        }

        return self::$instance;
    }

    /**
     * @return Collection
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @return $this
     */
    private function setValues()
    {
        $this->values = Product::all()->mapWithKeys(function($product){
            return [$product->id => $product->name . " (id: {$product->id})"];
        });

        return $this;
    }
}
