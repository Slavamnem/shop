<?php

namespace App\Strategies\Conditions;

use App\Category;

class CategoryCondition extends AbstractCondition
{
    /**
     * @return $this|AbstractCondition
     */
    public function setValues()
    {
        $this->values = Category::all()->mapWithKeys(function($category){
            return [$category->id => $category->name];
        });

        return $this;
    }
}
