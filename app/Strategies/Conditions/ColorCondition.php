<?php

namespace App\Strategies\Conditions;

use App\Color;

class ColorCondition extends AbstractCondition
{
    /**
     * @param null $type
     * @return $this|mixed
     */
    public function getValues($type = null)
    {
        if (empty($this->values)) {
            $this->values = Color::all()->mapWithKeys(function ($color) {
                return [$color->id => $color->name];
            });
        }

        return $this->values;
    }
}
