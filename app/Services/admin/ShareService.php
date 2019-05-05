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
     * @var array
     */
    private $conditionsOperations = ["=", "!=", "<", "<=", ">", ">=", "LIKE"];

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
     * @return array
     */
    public function getConditionsOperations()
    {
        return $this->conditionsOperations;
    }

    /**
     * @param $share
     * @return array
     */
    public function getOldConditionsData($share)
    {
        $conditionsData = [];
        foreach ((array)$share->conditions as $num => $condition) {
            array_push($conditionsData, [
                "conditions"         => $this->productService->getConditionsFields(),
                "operations"         => $this->getConditionsOperations(),
                "delimiterType"      => array_keys($condition)[0],
                "delimiterTypeTrans" => array_keys($condition)[0] == "or" ? "ИЛИ" : "И",
                "conditionId"        => $num,
                "conditionsAmount"   => $num,
                "currentCondition"   => $condition[array_keys($condition)[0]]["field"],
                "currentOperation"   => $condition[array_keys($condition)[0]]["operation"],
                "currentValues"      => $this->getConditionValues($condition[array_keys($condition)[0]]["field"]),
                "currentValue"       => $condition[array_keys($condition)[0]]["value"],
            ]);
        }

        return $conditionsData;
    }

    /**
     * @return array
     */
    public function getNewConditionData()
    {
        return [
            "conditions"         => $this->productService->getConditionsFields(),
            "operations"         => $this->conditionsOperations,
            "delimiterType"      => $this->request->delimiterType,
            "delimiterTypeTrans" => $this->request->delimiterType == "or" ? "ИЛИ" : "И",
            "conditionId"        => $this->request->conditionId,
            "conditionsAmount"   => $this->request->conditionsAmount
        ];
    }

    /**
     * @param string $conditionKey
     * @return array
     */
    public function getConditionValues($conditionKey)
    {
        $valuesHub = [
            "id" => Product::all()->mapWithKeys(function($product){
                return [$product->id => $product->name . " (id: {$product->id})"];
            }),
            "category_id" => Category::all()->mapWithKeys(function($category){
                return [$category->id => $category->name];
            }),
            "group_id" => ModelGroup::all()->mapWithKeys(function($group){
                return [$group->id => $group->name];
            }),
            "status_id" => ProductStatus::all()->mapWithKeys(function($status){
                return [$status->id => $status->name];
            }),
            "color_id" => Color::all()->mapWithKeys(function($color){
                return [$color->id => $color->name];
            }),
            "size_id" => Size::all()->mapWithKeys(function($size){
                return [$size->id => $size->name];
            }),
        ];

        $response = array_key_exists($conditionKey, $valuesHub) ? $valuesHub[$conditionKey] : [];
        return $response;
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
                "operation" => $this->request->operations[$num],
                "value"     => $this->request->conditions_values[$num]
            ];
        }

        $share->conditions = $conditionsData;
        //dump($conditionsData);
        //$this->getAccordingProducts($conditionsData);
    }

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