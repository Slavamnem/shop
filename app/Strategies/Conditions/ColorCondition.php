<?php

namespace App\Strategies\Conditions;

use App\Color;

class ColorCondition extends AbstractCondition
{
    /**
     * @return $this|AbstractCondition
     */
    public function setValues()
    {
        $this->values = Color::all()->mapWithKeys(function($color){
            return [$color->id => $color->name];
        });

        return $this;
    }
}
