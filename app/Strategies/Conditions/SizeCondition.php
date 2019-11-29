<?php

namespace App\Strategies\Conditions;

use App\Size;

class SizeCondition extends AbstractCondition
{
    /**
     * @param null $type
     * @return $this|mixed
     */
    public function getValues($type = null)
    {
        if (empty($this->values)) {
            $this->values = Size::all()->mapWithKeys(function ($size) {
                return [$size->id => $size->name];
            });
        }

        return $this->values;
    }
}
