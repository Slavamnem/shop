<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18.09.2019
 * Time: 0:33
 */

namespace App\Strategies\Interfaces;

interface ProductSortStrategyInterface
{
    /**
     * @param $queryBuilder
     * @return mixed
     */
    public function sort($queryBuilder);
}