<?php

namespace App\Services\Admin;

use App\Category;
use App\Color;
use App\ModelGroup;
use App\Product;
use App\ProductStatus;
use App\Services\Admin\Interfaces\ProductServiceInterface;
use App\Services\Admin\Interfaces\ShareServiceInterface;
use App\Share;
use App\Size;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShareService implements ShareServiceInterface
{
    /**
     * @var
     */
    private $request;
    /**
     * @var
     */
    private $productService;

    /**
     * ShareService constructor.
     * @param Request $request
     * @param ProductServiceInterface $productService
     */
    public function __construct(Request $request, ProductServiceInterface $productService)
    {
        $this->request = $request;
        $this->productService = $productService;
    }

    /**
     * @param Share $share
     * @return mixed|void
     */
    public function setConditions(Share $share)
    {
        $conditionsData = [];

        foreach ($this->conditionsGenerator() as $num => $condition) {
            $whereType = $this->request->conditions_delimiter;
            $conditionsData[][$whereType] = [
                "field"     => $condition,
                "operation" => array_get($this->request->input('operations'), $num),
                "value"     => array_get($this->request->input('conditions_values'), $num)
            ];
        }

        $share->conditions = $conditionsData;
    }

    /**
     * @return \Generator
     */
    private function conditionsGenerator()
    {
        if (!empty($this->request->conditions)) {
            foreach ($this->request->conditions as $num => $condition) {
                if ($this->isRealConditions($condition, $num)) yield $num => $condition;
            }
        }
    }

    /**
     * @param $condition
     * @param $num
     * @return bool
     */
    private function isRealConditions($condition, $num)
    {
        return (!empty($condition) and !empty($this->request->conditions_values[$num]));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getFilteredShares()
    {
        $shares = Share::query()
            ->where($this->request->input("field"),"like", "%" . $this->request->input("value") . "%")
            ->paginate(10);

        return $shares;
    }


    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * @param Product $product
     * @return mixed
     */
    public static function getProductShare(Product $product)
    {
        $shares = Share::active()->orderByDesc('priority')->get();

        foreach ($shares as $share) {
            if (self::productHasShare($product, $share)){
                return $share;
            }
        }
    }

    /**
     * @param Product $product
     * @return array
     */
    public static function getProductShares(Product $product)
    {
        $shares = Share::active()->get();
        $productShares = collect();

        foreach ($shares as $share) {
            if (self::productHasShare($product, $share)){
                $productShares->push($share);
            }
        }

        return $productShares;
    }

    /**
     * @param $product
     * @param $share
     * @return bool
     */
    public static function productHasShare($product, $share)
    {
        $shareProducts = self::getShareProducts($share);

        return (!empty($shareProducts->where("id", $product->id)->first()));
    }

    /**
     * @param $share
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    private static function getShareProducts($share) // TODO refactor
    {
        $query = Product::query();

        foreach ($share->conditions as $conditionsDataItem) {
            foreach ($conditionsDataItem as $key => $item) {
                if (self::isPropertyCondition($item)) {
                    if ($item["operation"] == "!=") {
                        $query = $query->whereDoesntHave("properties", function($q) use($item){
                            $q->where("product_properties.property_id", self::getPropertyConditionId($item))
                                ->where("product_properties.value", $item["value"]);
                        });
                    } else {
                        $query = $query->whereHas("properties", function($q) use($item){
                            $q->where("product_properties.property_id", self::getPropertyConditionId($item))
                                ->where("product_properties.value", $item["operation"], $item["value"]);
                        });
                    }
                } else {
                    if ($key == "and") {
                        $query = $query->where($item["field"], $item["operation"], $item["value"]);
                    } else {
                        $query = $query->orWhere($item["field"], $item["operation"], $item["value"]);
                    }
                }
            }
        }

        return $query->get();
    }

    private static function isPropertyCondition($item)
    {
        return strpos($item["field"], "property-") !== false;
    }

    private static function getPropertyConditionId($item)
    {
        return explode("-", $item["field"])[1];
    }
}




/*
// test

private function isPropertyCondition($item)
{
    return strpos($item["field"], "property-") !== false;
}

private function getPropertyConditionId($item)
{
    return explode("-", $item["field"])[1];
}

private function getAccordingProducts($conditionsData) //test function
{
    $query = Product::query();

    foreach ($conditionsData as $conditionsDataItem) {
        foreach ($conditionsDataItem as $key => $item) {
            if ($this->isPropertyCondition($item)) {
                if ($item["operation"] == "!=") {
                    $query = $query->whereDoesntHave("properties", function($q) use($item){
                        $q->where("product_properties.property_id", $this->getPropertyConditionId($item))
                            ->where("product_properties.value", $item["value"]);
                    });
                } else {
                    $query = $query->whereHas("properties", function($q) use($item){
                        $q->where("product_properties.property_id", $this->getPropertyConditionId($item))
                            ->where("product_properties.value", $item["operation"], $item["value"]);
                    });
                }
            } else {
                if ($key == "and") {
                    $query = $query->where($item["field"], $item["operation"], $item["value"]);
                } else {
                    $query = $query->orWhere($item["field"], $item["operation"], $item["value"]);
                }
            }

        }
    }

    dump($query->toSql());

    dump($query->get()->pluck("name"));
}*/