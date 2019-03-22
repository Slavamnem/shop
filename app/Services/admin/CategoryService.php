<?php

namespace App\Services\Admin;

use App\Category;
use App\Color;
use App\ModelGroup;
use App\Product;
use App\ProductStatus;
use App\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryService
{
    public static function getDataForCategoryPage($id = null)
    {
        $data = [
            "groups" => ModelGroup::all(),
            "statuses" => ProductStatus::all(),
            "colors" => Color::all(),
            "sizes" => Size::all()
        ];

        if ($id) {
            $data["category"] = Category::find($id);
        }

        return $data;
    }
}