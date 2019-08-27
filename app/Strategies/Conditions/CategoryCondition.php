<?php

namespace App\Strategies\Conditions;

use App\Category;

class CategoryCondition
{
    /**
     * @return Category[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getValues()
    {
        return Category::all()->mapWithKeys(function($category){
            return [$category->id => $category->name];
        });
    }
}
