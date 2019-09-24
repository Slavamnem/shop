<?php

namespace App\Strategies\ProductsSearch\Strategies;

use App\Components\Site\Api\Facet\Interfaces\FacetObjectInterface;
use App\Product;
use App\Services\Site\Interfaces\ProductsSearchServiceInterface;

abstract class AbstractProductsSearchService implements ProductsSearchServiceInterface
{
    /**
     * @var
     */
    protected $query;
    /**
     * @var FacetObjectInterface
     */
    protected $facetObject;

    public function __construct(){}

    /**
     * @param FacetObjectInterface $facetObject
     * @return mixed
     */
    public function getProductCount(FacetObjectInterface $facetObject)
    {
        $this->facetObject = $facetObject;
        $this->initQuery();
        $this->addPriceConditions();
        $this->addCategoryConditions();
        $this->addAttributesConditions();
        $this->addPropertiesConditions();

        return $this->getCountQueryResult();
    }

    /**
     * @param FacetObjectInterface $facetObject
     * @return mixed
     */
    public function search(FacetObjectInterface $facetObject)
    {
        $this->facetObject = $facetObject;
        $this->initQuery();
        $this->addPriceConditions();
        $this->addCategoryConditions();
        $this->addAttributesConditions();
        $this->addPropertiesConditions();
        $this->sortProducts();
        //$this->addLimit($this->facetObject->getPriceRange()->getMinPrice());

        return $this->getSearchQueryResult();
    }

    abstract function initQuery();

    abstract function getCountQueryResult();

    abstract function getSearchQueryResult();

    abstract function addPriceConditions();

    abstract function addCategoryConditions();

    abstract function addAttributesConditions();

    abstract function addPropertiesConditions();

    abstract function sortProducts();

    abstract function addLimit($limit);
}
