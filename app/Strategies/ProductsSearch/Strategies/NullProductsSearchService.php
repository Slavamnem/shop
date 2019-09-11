<?php

namespace App\Strategies\ProductsSearch\Strategies;

use App\Product;
use App\Services\Site\Interfaces\ProductsSearchServiceInterface;

class NullProductsSearchService extends AbstractProductsSearchService implements ProductsSearchServiceInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    public function initQuery(){
        $this->query = Product::query()->take(0);
    }

    /**
     * @return mixed
     */
    public function getCountQueryResult()
    {
        return 0;
    }

    /**
     * @return mixed
     */
    public function getSearchQueryResult()
    {
        return $this->query->paginate(element('catalog-per-page'));
    }

    public function addPriceConditions(){}

    public function addCategoryConditions(){}

    /**
     * @param $limit
     */
    public function addLimit($limit){}
}
