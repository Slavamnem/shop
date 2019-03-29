<?php

namespace App\Services\Admin;

use App\Category;
use App\Color;
use App\Enums\ProductStatusEnum;
use App\ModelGroup;
use App\Product;
use App\ProductStatus;
use App\Services\TranslatorService;
use App\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public static function getDataForProductPage($id = null)
    {
        $data = [
            "categories" => Category::all(),
            "groups" => ModelGroup::all(),
            "statuses" => ProductStatus::all(),
            "colors" => Color::all(),
            "sizes" => Size::all()
        ];

        if ($id) {
            $data["product"] = Product::find($id);
        }

        return $data;
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

    /**
     * Store chose product modifications for new group
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $groupId
     * @return \Illuminate\Http\Response
     */
    public function createModifications(Request $request, $groupId)
    {
        $newProducts = collect();
        foreach ($request->input("colors") as $colorId)
        {
            foreach ($request->input("sizes") as $sizeId)
            {
                $productName = $request->name
                    . " "
                    . Color::find($colorId)->name
                    . " "
                    . Size::find($sizeId)->name;
                $productSlug = $request->name
                    . "_"
                    . TranslatorService::translate(Color::find($colorId)->name)
                    . "_"
                    . TranslatorService::translate(Size::find($sizeId)->name);

                $newProducts->push([
                    'name' => $productName,
                    'slug' => $productSlug,
                    'base_price' => 0,
                    'quantity' => 0,
                    'category_id' => 1, // TODO category_id field in model group
                    'description' => '',
                    'image' => '',
                    'small_image' => '',
                    'group_id' => $groupId,
                    'status_id' => ProductStatusEnum::SOON_AVAILABLE,
                    'color_id' => $colorId,
                    'size_id' => $sizeId,
                ]);
            }
        }

        DB::table("products")->insert($newProducts->toArray());
        //dump($newProducts->toArray());

//        foreach (Product::getModificationsAttributes() as $attribute => $modelClass) {
//            if ($request->has($attribute))
//            {
//                dump($request->input($attribute));
//                $products = [];
//                foreach ($request->input($attribute) as $itemId) {
//                    $products[] = [
//                        'name' => $request->name . " " . $modelClass::select("name")->find($itemId)->name,
//                        'slug' => $request->name,
//                        'base_price' => 0,
//                        'quantity' => 0,
//                        'category_id' => 1,
//                        'description' => '',
//                        'image' => '',
//                        'small_image' => '',
//                        'group_id' => $groupId,
//                        'status_id' => 1,
//                        'color_id' => 1,
//                        'size_id' => 1,
//                    ];
//                }
//                dump($products);
//                //DB::table("products")->create($products);
//            }
//        }
    }
}