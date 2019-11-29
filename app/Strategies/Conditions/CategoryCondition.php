<?php

namespace App\Strategies\Conditions;

use App\Category;

class CategoryCondition extends AbstractCondition
{
    /**
     * @param null $type
     * @return $this|mixed
     */
    public function getValues($type = null)
    {
        if (empty($this->values)) {
            $this->values = Category::all()->mapWithKeys(function($category){
                return [$category->id => $category->name];
            });
        }

        return $this->values;
    }
}
