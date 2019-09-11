<?php

namespace App\Strategies\ProductsSearch;

use App\Components\Interfaces\PaymentTypeInterface;
use App\Services\Site\Interfaces\ProductsSearchServiceInterface;
use App\Strategies\Interfaces\StrategyInterface;
use App\Strategies\ProductsSearch\Strategies\DbProductsSearchService;
use App\Strategies\ProductsSearch\Strategies\ElasticProductsSearchService;
use App\Strategies\ProductsSearch\Strategies\NullProductsSearchService;
use Illuminate\Support\Collection;

class ProductsSearchStrategy implements StrategyInterface
{
    /**
     * @var Collection
     */
    private $strategies;

    public function __construct()
    {
        $this->loadStrategies();
    }

    public function loadStrategies()
    {
        $this->strategies = collect();
        $this->strategies->put('db', new DbProductsSearchService());
        $this->strategies->put('elastic', new ElasticProductsSearchService());
    }

    /**
     * @param $type
     * @return ProductsSearchServiceInterface
     */
    public function getStrategy($type){
        if (!$this->strategies->has($type)) {
            return new NullProductsSearchService();
        }

        return $this->strategies->get($type);
    }
}
