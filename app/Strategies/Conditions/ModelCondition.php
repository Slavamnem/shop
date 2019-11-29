<?php

namespace App\Strategies\Conditions;

use App\ModelGroup;

class ModelCondition extends AbstractCondition
{
    /**
     * @param null $type
     * @return $this|mixed
     */
    public function getValues($type = null)
    {
        if (empty($this->values)) {
            $this->values = ModelGroup::all()->mapWithKeys(function ($group) {
                return [$group->id => $group->name];
            });
        }

        return $this->values;
    }
}
