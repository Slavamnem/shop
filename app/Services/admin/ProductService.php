<?php

namespace App\Services\Admin;

use App\Category;
use App\Color;
use App\ModelGroup;
use App\Product;
use App\ProductStatus;
use App\Size;

class ProductService
{
    public static function getDataForProductEditPage($id)
    {
        return [
            "product" => Product::find($id),
            "categories" => Category::all(),
            "groups" => ModelGroup::all(),
            "statuses" => ProductStatus::all(),
            "colors" => Color::all(),
            "sizes" => Size::all()
        ];
    }
}