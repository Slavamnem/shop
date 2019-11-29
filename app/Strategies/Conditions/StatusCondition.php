<?php

namespace App\Strategies\Conditions;

use App\ProductStatus;

class StatusCondition extends AbstractCondition
{
    /**
     * @param null $type
     * @return $this|mixed
     */
    public function getValues($type = null)
    {
        if (empty($this->values)) {
            $this->values = ProductStatus::all()->mapWithKeys(function ($status) {
                return [$status->id => $status->name];
            });
        }

        return $this->values;
    }
}
