<?php

namespace App\Strategies\Conditions;

use App\ModelGroup;

class ModelCondition extends AbstractCondition
{
    /**
     * @return $this|\Illuminate\Support\Collection
     */
    public function setValues()
    {
        $this->values = ModelGroup::all()->mapWithKeys(function($group){
            return [$group->id => $group->name];
        });

        return $this;
    }
}
