<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12.09.2019
 * Time: 0:47
 */

namespace App\Strategies\FacetItem\Strategies;

use App\Components\Site\Api\Facet\Interfaces\FacetItemInterface;
use App\Strategies\Interfaces\FacetItemStrategyInterface;

class CategoryFacetItemStrategy implements FacetItemStrategyInterface
{
    /**
     * @param FacetItemInterface $facetItem
     * @return int
     */
    public function getMatchProductCount(FacetItemInterface $facetItem)
    {
        $fcObj = clone_object($facetItem->getFacetObject()); //$fcObj = clone $this->getFacetObject();

        $fcObj->addFilteredCategory(array_get(explode("-", $facetItem->getKey()), 1));

        return $fcObj->getProductsCount();
    }
}
