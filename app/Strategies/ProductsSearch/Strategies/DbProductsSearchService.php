<?php

namespace App\Strategies\ProductsSearch\Strategies;

use App\Product;
use App\Property;
use App\PropertyValue;
use App\Services\Site\Interfaces\ProductsSearchServiceInterface;
use App\Strategies\Interfaces\StrategyInterface;
use App\Strategies\ProductSort\ProductSortStrategy;
use App\Strategies\ProductsSearch\ProductsSearchStrategy;

class DbProductsSearchService extends AbstractProductsSearchService implements ProductsSearchServiceInterface
{
    /**
     * @var StrategyInterface
     */
    private $sortStrategy;

    public function __construct()
    {
        parent::__construct();
        $this->sortStrategy = new ProductSortStrategy();
    }

    public function initQuery()
    {
        $this->query = Product::query();
    }

    /**
     * @return mixed
     */
    public function getCountQueryResult()
    {
        return $this->query->count();
    }

    /**
     * @return mixed
     */
    public function getSearchQueryResult()
    {
        return $this->query->paginate(element('catalog-per-page'));
    }

    public function addPriceConditions()
    {
        $this->query = $this->query
            ->where('base_price', '>=', $this->facetObject->getPriceRange()->getMinPrice())
            ->where('base_price', '<=', $this->facetObject->getPriceRange()->getMaxPrice());
    }

    public function addCategoryConditions()
    {
        if ($this->facetObject->getFilteredCategories()) {
            $this->query = $this->query->whereIn('category_id', $this->facetObject->getFilteredCategories());
        }
    }

    public function addAttributesConditions()
    {
        foreach (Product::FACET_ATTRIBUTES as $attribute) {
            if ($this->facetObject->getFilteredAttributeValues($attribute)) {
                $this->query = $this->query->whereIn($attribute, $this->facetObject->getFilteredAttributeValues($attribute));
            }
        }
    }

    public function addPropertiesConditions()
    {
        foreach (Property::all() as $property) {
            if ($this->facetObject->getFilteredPropertyValues("property-{$property->id}")) {
                $this->query = $this->query->whereHas("propertyValues", function($query) use($property){
                    $query->where("property_values.property_id", $property->id)
                        ->whereIn("property_values.id", $this->facetObject->getFilteredPropertyValues("property-{$property->id}"));
                });
            }
        }
    }

    public function sortProducts()
    {
        $this->sortStrategy->getStrategy($this->facetObject->getSortingType())->sort($this->query);
    }

    /**
     * @param $limit
     */
    public function addLimit($limit)
    {
        $this->query = $this->query->take($limit);
    }
}
