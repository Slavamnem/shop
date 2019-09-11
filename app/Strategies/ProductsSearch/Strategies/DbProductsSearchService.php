<?php

namespace App\Strategies\ProductsSearch\Strategies;

use App\Product;
use App\Services\Site\Interfaces\ProductsSearchServiceInterface;

class DbProductsSearchService extends AbstractProductsSearchService implements ProductsSearchServiceInterface
{
    public function __construct()
    {
        parent::__construct();
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

    /**
     * @param $limit
     */
    public function addLimit($limit)
    {
        $this->query = $this->query->take($limit);
    }
}
