<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 14.09.2019
 * Time: 23:16
 */

namespace App\Components\Site\Api\Facet;


use App\Components\Site\Api\Facet\Interfaces\FacetItemInterface;
use App\Components\Site\Api\Facet\Interfaces\FacetObjectInterface;
use App\Objects\SectionFacetItemObject;
use App\Product;

class SectionFacetItem extends CompositeFacetItem implements FacetItemInterface
{
    /**
     * @return bool
     */
    public function isSection()
    {
        return true;
    }

    /** TODO unused
     * @param SectionFacetItemObject $object
     * @return SectionFacetItem
     */
    public static function create(SectionFacetItemObject $object)
    {
        return (new self($object->getKey()))
            ->setTitle((new Product())->getFieldTranslation($object->getTitle()))
            ->setAttributeName('')
            ->setIsMarked(false)
            ->setFacetObject($object->getFacetObject());
    }
}
