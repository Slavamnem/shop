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

class AttributeFacetItemStrategy implements FacetItemStrategyInterface
{
    /**
     * @param FacetItemInterface $facetItem
     * @return int
     */
    public function getMatchProductCount(FacetItemInterface $facetItem)
    {
        $fcObj = clone_object($facetItem->getFacetObject());

        list($attribute, $value) = explode("-", $facetItem->getKey());
        $fcObj->addFilteredAttributeValue($attribute, $value);

        return $fcObj->getProductsCount();
    }
}
