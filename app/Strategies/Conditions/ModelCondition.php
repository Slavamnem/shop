<?php

namespace App\Strategies\Conditions;

use App\ModelGroup;

class ModelCondition
{
    /**
     * @return ModelGroup[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getValues()
    {
        return ModelGroup::all()->mapWithKeys(function($group){
            return [$group->id => $group->name];
        });
    }
}