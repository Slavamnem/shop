<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18.09.2019
 * Time: 0:35
 */

namespace App\Strategies\ProductSort\Strategies;

use App\Strategies\Interfaces\ProductSortStrategyInterface;

class PriceDescStrategy implements ProductSortStrategyInterface
{
    /**
     * @param $queryBuilder
     * @return mixed
     */
    public function sort($queryBuilder)
    {
        return $queryBuilder->orderByDesc('base_price');
    }
}
