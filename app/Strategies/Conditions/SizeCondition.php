<?php

namespace App\Strategies\Conditions;

use App\Size;

class SizeCondition extends AbstractCondition
{
    /**
     * @return $this|AbstractCondition
     */
    public function setValues()
    {
        $this->values = Size::all()->mapWithKeys(function($size){
            return [$size->id => $size->name];
        });

        return $this;
    }
}
