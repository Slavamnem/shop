<?php

namespace App\Builders;

use App\Builders\Interfaces\ShareProductsQueryBuilderInterface;
use App\Components\Condition;
use App\Enums\ConditionDelimiterTypesEnum;
use App\Product;
use Illuminate\Database\Query\Builder;

class ShareProductsQueryBuilder implements ShareProductsQueryBuilderInterface
{
    /**
     * @var Builder
     */
    private $queryBuilder;

    public function init()
    {
        $this->queryBuilder = Product::query();
    }

    /**
     * @param $productId
     * @return $this
     */
    public function addProductCondition($productId)
    {
        $this->queryBuilder = $this->queryBuilder->where('id', $productId);
        return $this;
    }
    /**
     * @param Condition $condition
     */
    public function addPropertyCondition(Condition $condition)
    {
        if ($condition->getDelimiter() == ConditionDelimiterTypesEnum::AND) {
            $this->queryBuilder = $this->queryBuilder->whereHas("properties", function($q) use($condition){
                $q->where("product_properties.property_id", $condition->getPropertyConditionId())
                    ->where("product_properties.value", $condition->getOperation(), $condition->getCurrentValue());
            });
        } else {
            $this->queryBuilder = $this->queryBuilder->orWhereHas("properties", function($q) use($condition){
                $q->where("product_properties.property_id", $condition->getPropertyConditionId())
                    ->where("product_properties.value", $condition->getOperation(), $condition->getCurrentValue());
            });
        }
    }

    /**
     * @param Condition $condition
     */
    public function addAttributeCondition(Condition $condition)
    {
        if ($condition->getDelimiter() == ConditionDelimiterTypesEnum::AND) {
            $this->queryBuilder = $this->queryBuilder->where(
                $condition->getField(),
                $condition->getOperation(),
                $condition->getCurrentValue()
            );
        } else {
            $this->queryBuilder = $this->queryBuilder->orWhere(
                $condition->getField(),
                $condition->getOperation(),
                $condition->getCurrentValue()
            );
        }
    }

    /**
     * @return Builder
     */
    public function getQueryBuilder()
    {
        return $this->queryBuilder;
    }
}

//        if ($condition->getOperation() == "!=") {
////            $query = $query->whereDoesntHave("properties", function($q) use($condition){
////                $q->where("product_properties.property_id", $condition->getPropertyConditionId())
////                    ->where("product_properties.value", $condition->getCurrentValue());
////            });
////        } else {
////            $query = $query->whereHas("properties", function($q) use($condition){
////                $q->where("product_properties.property_id", $condition->getPropertyConditionId())
////                    ->where("product_properties.value", $condition->getOperation(), $condition->getCurrentValue());
////            });
////        }