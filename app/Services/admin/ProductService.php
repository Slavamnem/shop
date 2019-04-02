<?php

namespace App\Services\Admin;

use App\Category;
use App\Color;
use App\Enums\ProductStatusEnum;
use App\ModelGroup;
use App\Product;
use App\ProductStatus;
use App\Services\Admin\Interfaces\ProductServiceInterface;
use App\Services\TranslatorService;
use App\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductService implements ProductServiceInterface
{
    /**
     * @var Request
     */
    private $request;

    /**
     * ProductServiceInterface constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param $id
     * @return array
     */
    public function getData($id = null)
    {
        return [
            "product"    => ($id)? Product::find($id) : null,
            "categories" => Category::all(),
            "groups"     => ModelGroup::all(),
            "statuses"   => ProductStatus::all(),
            "colors"     => Color::all(),
            "sizes"      => Size::all()
        ];
    }

    /**
     * @param Product $product
     */
    public function saveImages(Product $product)
    {
        $images = Product::getImagesAttributesKeys();

        foreach ($images as $img) {
            if ($this->request->hasFile($img)) {
                $imageName = $this->generateProductImageName($product, $img);
                $product->$img = "products/{$imageName}";

                Storage::putFileAs(
                    "products",
                    $this->request->file($img),
                    $imageName
                );
            }
        }
    }

    /**
     * Store chose product modifications for new group
     *
     * @param  ModelGroup $group
     */
    public function createModifications(ModelGroup $group)
    {
        $newProducts = collect();

        foreach ($this->request->input("colors") as $colorId)
        {
            foreach ($this->request->input("sizes") as $sizeId)
            {
                $this->addNewProduct($newProducts, $group, $colorId, $sizeId);
            }
        }

        DB::table("products")->insert($newProducts->toArray());
    }

    /**
     * @param Collection $newProducts
     * @param $group
     * @param $colorId
     * @param $sizeId
     */
    private function addNewProduct(Collection $newProducts, $group, $colorId, $sizeId)
    {
        $newProducts->push([
            'name'        => $this->generateProductName($colorId, $sizeId),
            'slug'        => $this->generateProductSlug($colorId, $sizeId),
            'base_price'  => 0,
            'quantity'    => 0,
            'category_id' => $group->category_id,
            'description' => '',
            'image'       => '',
            'small_image' => '',
            'group_id'    => $group->id,
            'status_id'   => ProductStatusEnum::SOON_AVAILABLE,
            'color_id'    => $colorId,
            'size_id'     => $sizeId,
        ]);
    }

    /**
     * @param Product $product
     * @param string $imageField
     * @return string
     */
    private function generateProductImageName(Product $product, string $imageField)
    {
        $productId = $product->id ?? DB::table("products")->max("id") + 1;
        return "product_" . $productId . "_{$imageField}." . $this->request->file($imageField)->extension();
    }

    /**
     * @param $colorId
     * @param $sizeId
     * @return string
     */
    private function generateProductName($colorId, $sizeId)
    {
        return $this->request->name
            . " "
            . Color::find($colorId)->name
            . " "
            . Size::find($sizeId)->name;

    }

    /**
     * @param $colorId
     * @param $sizeId
     * @return string
     */
    private function generateProductSlug($colorId, $sizeId)
    {
        return $this->request->name
        . "_"
        . TranslatorService::translate(Color::find($colorId)->name)
        . "_"
        . TranslatorService::translate(Size::find($sizeId)->name);
    }
}