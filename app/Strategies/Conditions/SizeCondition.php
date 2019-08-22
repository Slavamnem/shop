<?php

namespace App\Strategies\Conditions;

use App\Size;

class SizeCondition
{
    /**
     * @return Size[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getValues()
    {
        return Size::all()->mapWithKeys(function($size){
            return [$size->id => $size->name];
        });
    }
}