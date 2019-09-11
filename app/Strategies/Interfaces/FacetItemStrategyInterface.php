<?php

namespace App\Strategies\Interfaces;

use App\Components\Site\Api\Facet\Interfaces\FacetItemInterface;

interface FacetItemStrategyInterface
{
    /**
     * @param FacetItemInterface $facetItem
     * @return int
     */
    public function getMatchProductCount(FacetItemInterface $facetItem);
}
