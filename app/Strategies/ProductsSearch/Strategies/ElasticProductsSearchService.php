<?php

namespace App\Strategies\ProductsSearch\Strategies;

use App\Services\Site\Interfaces\ProductsSearchServiceInterface;

class ElasticProductsSearchService extends AbstractProductsSearchService implements ProductsSearchServiceInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    public function initQuery()
    {

    }

    /**
     * @return mixed
     */
    public function getCountQueryResult()
    {

    }

    /**
     * @return mixed
     */
    public function getSearchQueryResult()
    {

    }

    public function addPriceConditions()
    {

    }

    public function addCategoryConditions()
    {

    }

    public function addAttributesConditions()
    {

    }

    public function addPropertiesConditions()
    {
        // TODO: Implement addPropertiesConditions() method.
    }

    public function sortProducts()
    {

    }

    /**
     * @param $limit
     */
    public function addLimit($limit)
    {

    }
}
