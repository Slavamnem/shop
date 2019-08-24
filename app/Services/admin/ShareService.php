<?php

namespace App\Services\Admin;

use App\Adapters\ConditionAdapter;
use App\Builders\Interfaces\ShareProductsQueryBuilderInterface;
use App\Category;
use App\Color;
use App\Components\Condition;
use App\Enums\ConditionDelimiterTypesEnum;
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
     * @var ShareProductsQueryBuilderInterface
     */
    private $shareProductsBuilder;

    /**
     * ShareService constructor.
     * @param Request $request
     * @param ShareProductsQueryBuilderInterface $shareProductsBuilder
     */
    public function __construct(Request $request, ShareProductsQueryBuilderInterface $shareProductsBuilder)
    {
        $this->request = $request;
        $this->shareProductsBuilder = $shareProductsBuilder;
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
    public function getProductShare(Product $product)
    {
        $shares = Share::active()->orderByDesc('priority')->get();

        foreach ($shares as $share) {
            if ($this->productHasShare($product, $share)){ //dump($share);
                return $share;
            }
        }
    }

    /**
     * @param Product $product
     * @return array
     */
    public function getProductShares(Product $product)
    {
        $shares = Share::active()->get();
        $productShares = collect();

        foreach ($shares as $share) {
            if ($this->productHasShare($product, $share)){
                $productShares->push($share);
            }
        }

        return $productShares;
    }

    /**
     * @param Product $product
     * @param Share $share
     * @return bool|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|null|object
     */
    public function productHasShare(Product $product, Share $share)
    {
        return $this->getShareProductsQueryBuilder($share)
            ->addProductCondition($product->getId())
            ->getQueryBuilder()
            ->first();
    }

    /**
     * @param $share
     * @return ShareProductsQueryBuilderInterface
     */
    private function getShareProductsQueryBuilder($share)
    {
        $this->shareProductsBuilder->init();

        foreach ($share->conditions as $conditionsDataItem) {
            foreach ($conditionsDataItem as $delimiter => $condition) {
                //$condition = ConditionAdapter::getFromShareConditionData($condition, $delimiter); // TODO имеет ли смысл?
                $condition = (new Condition())
                    ->setField(array_get($condition, 'field'))
                    ->setOperation(array_get($condition, 'operation'))
                    ->setCurrentValue(array_get($condition, 'value'))
                    ->setDelimiter($delimiter);

                if ($condition->isPropertyCondition()) { //TODO подумать о стратегии в случае если добавится еще 1 тип условий
                    $this->shareProductsBuilder->addPropertyCondition($condition);
                } else {
                    $this->shareProductsBuilder->addAttributeCondition($condition);
                }
            }
        }

        return $this->shareProductsBuilder;
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