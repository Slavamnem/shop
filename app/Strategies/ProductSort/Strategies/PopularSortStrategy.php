<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18.09.2019
 * Time: 0:34
 */

namespace App\Strategies\ProductSort\Strategies;

use App\Strategies\Interfaces\ProductSortStrategyInterface;
use Illuminate\Support\Facades\DB;

class PopularSortStrategy implements ProductSortStrategyInterface
{
    /**
     * @param $queryBuilder
     * @return mixed
     */
    public function sort($queryBuilder)
    {
//        return $queryBuilder
//            ->join('order_products', 'products.id', '=', 'order_products.product_id')
//            ->orderByRaw('SUM(products.order_products.quantity)');

        return $queryBuilder;
            //->join('order_products', 'products.id', '=', 'order_products.product_id')
            //->addSelect(DB::raw('SUM(order_products.id) as total'));
            //->orderBy('total');
            //->groupBy('total')
            //->orderBy(DB::raw('SUM(order_products.id)'));
            //->orderByRaw('SUM(order_products.quantity)');
    }
}
