<?php

namespace App\Strategies\Conditions;

use App\Color;

class ColorCondition
{
    /**
     * @return Color[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getValues()
    {
        return Color::all()->mapWithKeys(function($color){
            return [$color->id => $color->name];
        });
    }
}
