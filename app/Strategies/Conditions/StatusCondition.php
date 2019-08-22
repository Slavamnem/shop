<?php

namespace App\Strategies\Conditions;

use App\ProductStatus;

class StatusCondition
{
    /**
     * @return ProductStatus[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getValues()
    {
        return ProductStatus::all()->mapWithKeys(function($status){
            return [$status->id => $status->name];
        });
    }
}