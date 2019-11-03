<?php

namespace App\Services\Admin;

use App\Builders\Interfaces\DocumentBuilderInterface;
use App\Category;
use App\Color;
use App\Components\AppCenter;
use App\Components\Helpers\ProductHelper;
use App\Components\SecurityCenter;
use App\Components\Signals\TrojanHorseSignal;
use App\Enums\ProductStatusEnum;
use App\Http\Requests\Admin\ProductRequest;
use App\ModelGroup;
use App\Objects\ModificationProductObject;
use App\Product;
use App\ProductImage;
use App\ProductStatus;
use App\Property;
use App\Services\Admin\Interfaces\ProductServiceInterface;
use App\Services\Admin\Interfaces\ShareServiceInterface;
use App\Services\TranslatorService;
use App\Size;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductService implements ProductServiceInterface
{
    /**
     * @var Request
     */
    private $request;
    /**
     * @var ShareServiceInterface
     */
    private $shareService;

    /**
     * ProductService constructor.
     * @param Request $request
     * @param ShareServiceInterface $shareService
     */
    public function __construct(Request $request, ShareServiceInterface $shareService)
    {
        $this->request = $request;
        $this->shareService = $shareService;
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getFilteredProducts() // TODO refactor
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
     * @param $product
     * @return float|int
     */
    public function getPrice($product)
    {
        $price = $product->base_price;

        if ($productShare = $this->shareService->getProductShare($product)) {
            if ($productShare->fix_price) {
                $price = $productShare->fix_price;
            } elseif ($productShare->discount) {
                $price = ProductHelper::getDiscountPrice($price, $productShare->discount);
            }
        }

        return $price;
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

    /**
     * @param Product $product
     * @param ProductRequest $request
     */
    public function saveImages(Product $product, ProductRequest $request)
    {
        $this->updateOldImages($product, $request);
        $this->saveNewImages($product, $request);
    }

    /**
     * @param Product $product
     * @param ProductRequest $request
     * @return mixed|void
     */
    public function saveProperties(Product $product, ProductRequest $request)
    {
        $properties = collect();
        foreach ($request->getProperties() as $number => $propertyId) {
            if ($propertyValue = $request->getPropertyValue($number)) {
                $properties->put($propertyId, [
                    "property_value_id" => $propertyValue,
                    "ordering" => $request->getPropertyOrdering($number)
                ]);
            }
        }
        $product->properties()->sync($properties->toArray());
    }

    /**
     * Store chose product modifications for new group
     *
     * @param  ModelGroup $model
     */
    public function createModifications(ModelGroup $model)
    {
        $newProducts = collect();

        foreach ($this->request->input("colors") as $colorId)
        {
            foreach ($this->request->input("sizes") as $sizeId)
            {
                $this->addNewProduct(
                    (new ModificationProductObject())
                        ->setNewProducts($newProducts)
                        ->setModel($model)
                        ->setColor((new Color())->setId($colorId))
                        ->setSize((new Size())->setId($sizeId))
                );
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
     * @param ModificationProductObject $modificationProductObject
     */
    private function addNewProduct(ModificationProductObject $modificationProductObject)
    {
        $modificationProductObject->getNewProducts()->push([
            'name'        => $this->generateProductName($modificationProductObject->getColor()->getId(), $modificationProductObject->getSize()->getId()),
            'slug'        => $this->generateProductSlug($modificationProductObject->getColor()->getId(), $modificationProductObject->getSize()->getId()),
            'base_price'  => 0, //TODO сделать во время создания модификаций возможностб указать всем цену и количество
            'quantity'    => 0,
            'category_id' => $modificationProductObject->getModel()->category_id,
            'description' => '',
            'group_id'    => $modificationProductObject->getModel()->id,
            'status_id'   => ProductStatusEnum::SOON_AVAILABLE()->getValue(),
            'color_id'    => $modificationProductObject->getColor()->getId(),
            'size_id'     => $modificationProductObject->getSize()->getId(),
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
        return $this->request->input('name')
            . " "
            . Color::find($colorId)->getName()
            . " "
            . Size::find($sizeId)->getName();
    }

    /**
     * @param $colorId
     * @param $sizeId
     * @return string
     */
    private function generateProductSlug($colorId, $sizeId)
    {
        return $this->request->input('name')
        . "_"
        . TranslatorService::translate(Color::find($colorId)->getName())
        . "_"
        . TranslatorService::translate(Size::find($sizeId)->getName());
    }

    /**
     * @param Product $product
     * @param ProductRequest $request
     */
    private function updateOldImages(Product $product, ProductRequest $request): void
    {
        ProductImage::query()
            ->whereNotIn("id", $request->getOldImages())
            ->where("product_id", $product->getId())
            ->delete();

        foreach ($request->getOldImages() as $imgId) {
            ProductImage::where("id", $imgId)->update([
                "main"     => $request->getOldImageIsMain($imgId),
                "preview"  => $request->getOldImageIsPreview($imgId),
                "ordering" => $request->getOldImageOrdering($imgId)
            ]);
        }
    }

    /**
     * @param Product $product
     * @param ProductRequest $request
     */
    private function saveNewImages(Product $product, ProductRequest $request): void
    {
        foreach ($request->getNewImages() as $imgId => $img) {
            $imageName = $this->generateProductImageName($product, $img);

            if (App::make(SecurityCenter::class)->checkImage($img)) {
                Storage::putFileAs("products", $img, $imageName);

                //$this->saveToDropBox($img);

                $product->images()->create([
                    'url' => "products/{$imageName}",
                    'product_id' => $product->getId(),
                    'main' => $request->getNewImageIsMain($imgId),
                    'preview' => $request->getNewImageIsPreview($imgId),
                    'ordering' => $request->getNewImageOrdering($imgId),
                ]);
            } else {
                //App::make(AppCenter::class)->sendSignal(new TrojanHorseSignal());
            }
        }
    }
}
