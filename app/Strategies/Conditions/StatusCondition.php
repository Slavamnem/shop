<?php

namespace App\Strategies\Conditions;

use App\ProductStatus;

class StatusCondition extends AbstractCondition
{
    /**
     * @return $this|AbstractCondition
     */
    public function setValues()
    {
        $this->values = ProductStatus::all()->mapWithKeys(function($status){
            return [$status->id => $status->name];
        });

        return $this;
    }
}
