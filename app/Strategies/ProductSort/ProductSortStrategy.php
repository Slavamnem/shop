<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18.09.2019
 * Time: 0:31
 */

namespace App\Strategies\ProductSort;


use App\Strategies\Interfaces\ProductSortStrategyInterface;
use App\Strategies\Interfaces\StrategyInterface;
use App\Strategies\ProductSort\Strategies\NullSortStrategy;
use App\Strategies\ProductSort\Strategies\PopularSortStrategy;
use App\Strategies\ProductSort\Strategies\PriceAscStrategy;
use App\Strategies\ProductSort\Strategies\PriceDescStrategy;
use Illuminate\Support\Collection;

class ProductSortStrategy implements StrategyInterface
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
        $this->strategies->put('popular', new PopularSortStrategy());
        $this->strategies->put('price-asc', new PriceAscStrategy());
        $this->strategies->put('price-desc', new PriceDescStrategy());
    }

    /**
     * @param $type
     * @return ProductSortStrategyInterface
     */
    public function getStrategy($type){
        if (!$this->strategies->has($type)) {
            return new NullSortStrategy();
        }

        return $this->strategies->get($type);
    }
}
