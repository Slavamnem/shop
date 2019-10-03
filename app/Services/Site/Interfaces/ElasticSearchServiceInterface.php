<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 01.10.2019
 * Time: 0:33
 */

namespace App\Services\Site\Interfaces;


use App\Product;

interface ElasticSearchServiceInterface
{
    /**
     * @param Product $product
     */
    public function indexProduct(Product $product);

    /**
     * @param $params
     * @return array|callable
     */
    public function searchByQuery($params);

    /**
     * @return array
     */
    public function getProductSource();
}
