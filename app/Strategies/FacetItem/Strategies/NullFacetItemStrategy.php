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

class NullFacetItemStrategy implements FacetItemStrategyInterface
{
    /**
     * @param FacetItemInterface $facetItem
     * @return int
     */
    public function getMatchProductCount(FacetItemInterface $facetItem)
    {
        return 0;
    }
}
