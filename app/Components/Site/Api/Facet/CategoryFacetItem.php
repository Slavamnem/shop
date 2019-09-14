<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 14.09.2019
 * Time: 23:15
 */

namespace App\Components\Site\Api\Facet;


use App\Components\Site\Api\Facet\Interfaces\FacetItemInterface;

class CategoryFacetItem extends CompositeFacetItem implements FacetItemInterface
{
    /**
     * @return int
     */
    public function getMatchProductCount()
    {
        return $this->facetItemStrategy->getStrategy('category')->getMatchProductCount($this);
    }
}
