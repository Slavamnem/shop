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

    public static function getDataForProductCreatePage()
    {
        return [
            "categories" => Category::all(),
            "groups" => ModelGroup::all(),
            "statuses" => ProductStatus::all(),
            "colors" => Color::all(),
            "sizes" => Size::all()
        ];
    }

    public static function saveImages(Request $request, $product)
    {
        $images = Product::getImagesAttributesKeys();

        foreach ($images as $img) {
            if ($request->hasFile($img)) {
                $name = "product_" . $product->id . "_{$img}." . $request->file($img)->extension();
                $product->$img = "products/{$name}";
                Storage::putFileAs(
                    "products",
                    $request->file($img),
                    $name
                );
            }
        }
    }
}