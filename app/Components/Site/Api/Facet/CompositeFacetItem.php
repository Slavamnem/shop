<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 14.09.2019
 * Time: 23:12
 */

namespace App\Components\Site\Api\Facet;

use App\Components\Site\Api\Facet\Interfaces\FacetItemInterface;
use Illuminate\Support\Collection;

class CompositeFacetItem extends AbstractFacetItem implements FacetItemInterface
{
    /**
     * @param FacetItemInterface $item
     */
    public function addChildItem(FacetItemInterface $item)
    {
        $this->childrenItems->push($item);
    }

    /**
     * @return Collection
     */
    public function getChildren()
    {
        return $this->childrenItems;
    }
}
