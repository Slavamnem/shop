<?php

namespace App\Services\Admin;

use App\Builders\Interfaces\DocumentBuilderInterface;
use App\Category;
use App\Color;
use App\Components\Interfaces\SaveDataToFileInterface;
use App\Enums\ProductStatusEnum;
use App\ModelGroup;
use App\Product;
use App\ProductImage;
use App\ProductStatus;
use App\Property;
use App\Services\Admin\Interfaces\ProductServiceInterface;
use App\Services\Admin\Interfaces\TableFilterDataInterface;
use App\Services\TranslatorService;
use App\Size;
use Elasticsearch\ClientBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getFilteredProducts()
    {
        $specialFields = [
            "category_id" => "category",
            "group_id"    => "group",
            "status_id"   => "status",
            "color_id"    => "color",
            "size_id"     => "size"
        ];

        $query = Product::query()->with(['color', 'size', 'category']);

        if (array_key_exists($this->request->input("field"), $specialFields)) {
            $query = $query->whereHas($specialFields[$this->request->input("field")], function($q){
                $q->where("name", "like", "%" . $this->request->input("value") . "%");
            });
        } else {
            $query = $query->where($this->request->input("field"),"like", "%" . $this->request->input("value") . "%");
        }

        $products = $query->paginate(10);

        return $products;
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
            "sizes"      => Size::all(),
            "properties" => Property::all(),
        ];
    }

//    public function saveImagesOld(Product $product)
//    {
//        dd($this->request->all());
//        $images = Product::getImagesAttributesKeys();
//
//        foreach ($images as $img) {
//            if ($this->request->hasFile($img)) {
//                $imageName = $this->generateProductImageName($product, $img);
//                $product->$img = "products/{$imageName}";
//
//                Storage::putFileAs(
//                    "products",
//                    $this->request->file($img),
//                    $imageName
//                );
//            }
//        }
//    }

    /**
     * @param Product $product
     * @throws \Exception
     */
    public function saveImages(Product $product)
    {
        $this->updateOldImages($product);
        $this->saveNewImages($product);
    }

    /**
     * @param Product $product
     * @return mixed|void
     */
    public function saveProperties(Product $product)
    {
        $properties = collect();
        foreach ((array)$this->request->input('properties') as $number => $propertyId) {
            $value = $this->request->input('properties_values')[$number];
            $ordering = $this->request->input('properties_ordering')[$number];
            if ($value) {
                $properties->put($propertyId, [
                    "value"    => $value,
                    "ordering" => $ordering
                ]);
            }
        }
        $product->properties()->sync($properties->toArray());
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
     * @param DocumentBuilderInterface $builder
     * @param $data
     * @param $fileName
     * @return mixed|string
     */
    public function saveToFile(DocumentBuilderInterface $builder, $data, $fileName)
    {
        $builder->createDocument($fileName);

        foreach ($data as $key => $item) {
            $builder->addRow($item, "product");
        }

        $builder->saveDocument();

        return response()->download($builder->getDocument()->getPath());
    }

    /**
     * @return array|mixed
     */
    public function getConditionsFields()
    {
        $result = [];
        foreach ((new Product())->getFieldsTranslations() as $field => $translation) {
            $result[$field] = $translation;
        }

        foreach (Property::all() as $property) {
            $result["property-{$property->id}"] = $property->name;
        }

        return $result;
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
            'group_id'    => $group->id,
            'status_id'   => ProductStatusEnum::SOON_AVAILABLE,
            'color_id'    => $colorId,
            'size_id'     => $sizeId,
        ]);
    }

    /**
     * @param Product $product
     * @param $img
     * @return string
     */
    private function generateProductImageName(Product $product, $img)
    {
        $productId = $product->id ?? DB::table("products")->max("id") + 1;
        return "product_" . $productId . "_" . $img->getClientOriginalName();
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

    /**
     * @param Product $product
     */
    private function updateOldImages(Product $product): void
    {
        ProductImage::query()
            ->whereNotIn("id", (array)@$this->request->oldImages)
            ->where("product_id", $product->id)
            ->delete();

        foreach ((array)@$this->request->oldImages as $imgId) {
            ProductImage::where("id", $imgId)->update([
                "main"     => $this->request->oldImagesMain[$imgId] ?? 0,
                "preview"  => $this->request->oldImagesPreview[$imgId] ?? 0,
                "ordering" => $this->request->oldImagesOrdering[$imgId] ?? 100
            ]);
        }
    }

    /**
     * @param Product $product
     */
    private function saveNewImages(Product $product): void
    {
        foreach ((array)@$this->request->newImages as $imgId => $img) {
            $imageName = $this->generateProductImageName($product, $img);
            Storage::putFileAs("products", $img, $imageName);

            $product->images()->create([
                'url'        => "products/{$imageName}",
                'product_id' => $product->id,
                'main'       => @$this->request->newImagesMain[$imgId] ?? 0,
                'preview'    => @$this->request->newImagesPreview[$imgId] ?? 0,
                'ordering'   => @$this->request->newImagesOrdering[$imgId] ?? 100,
            ]);
        }
    }
}
