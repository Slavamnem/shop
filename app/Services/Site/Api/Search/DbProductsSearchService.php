<?php

namespace App\Services\Site\Api\Search;

use App\Components\Site\Api\Facet\Interfaces\FacetObjectInterface;
use App\Product;
use App\Services\Site\Interfaces\ProductsSearchServiceInterface;

class DbProductsSearchService implements ProductsSearchServiceInterface
{
    /**
     * @var
     */
    private $query;
    /**
     * @var FacetObjectInterface
     */
    private $facetObject;

    public function __construct(FacetObjectInterface $facetObject)
    {
        $this->facetObject = $facetObject;
        $this->initQuery();
    }

    public function initQuery()
    {
        $this->query = Product::query();
    }

    public function search()
    {
        $this->addPriceConditions();
        $this->addCategoryConditions();
        //$this->addLimit($this->facetObject->getPriceRange()->getMinPrice());

        return $this->query->paginate(element('catalog-per-page'));
    }

    private function addPriceConditions()
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
    private function addLimit($limit)
    {
        $this->query = $this->query->take($limit);
    }
}
