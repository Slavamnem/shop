<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 14.09.2019
 * Time: 22:41
 */

namespace App\Components\Site\Api\Facet;

use App\Category;
use App\Components\Site\Api\Facet\Interfaces\FacetItemInterface;
use App\Components\Site\Api\Facet\Interfaces\FacetObjectInterface;
use App\Http\Requests\Site\Api\CatalogProductsFilterRequest;
use App\Objects\AttributeFacetItemObject;
use App\Strategies\FacetItem\FacetItemStrategy;
use App\Strategies\Interfaces\StrategyInterface;
use Illuminate\Support\Collection;

abstract class AbstractFacetItem implements FacetItemInterface
{
    /**
     * @var string
     */
    protected $key;
    /**
     * @var string
     */
    protected $title;
    /**
     * @var attribute name in html checkbox
     */
    protected $attributeName;
    /**
     * @var bool
     */
    protected $isMarked;
    /**
     * @var Collection
     */
    protected $childrenItems;
    /**
     * @var FacetObjectInterface
     */
    protected $facetObject;
    /**
     * @var StrategyInterface
     */
    protected $facetItemStrategy;

    /**
     * FacetItem constructor.
     * @param $key
     */
    public function __construct($key)
    {
        $this->key = $key;
        $this->childrenItems = collect();
        $this->facetItemStrategy = new FacetItemStrategy();
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setTitle($value)
    {
        $this->title = $value;
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setAttributeName($value)
    {
        $this->attributeName = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAttributeName()
    {
        return $this->attributeName;
    }

    /**
     * @return bool
     */
    public function getIsMarked()
    {
        return $this->isMarked;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setIsMarked($value)
    {
        $this->isMarked = $value;
        return $this;
    }

    /**
     * @return $this
     */
    public function mark()
    {
        $this->isMarked = true;
        return $this;
    }

    /**
     * @return $this
     */
    public function unMark()
    {
        $this->isMarked = false;
        return $this;
    }

    /**
     * @param FacetObjectInterface $facetObject
     * @return $this
     */
    public function setFacetObject(FacetObjectInterface $facetObject)
    {
        $this->facetObject = $facetObject;
        return $this;
    }

    /**
     * @return FacetObjectInterface
     */
    public function getFacetObject()
    {
        return $this->facetObject;
    }

    /**
     * @param FacetItemInterface $item
     */
    public function addChildItem(FacetItemInterface $item)
    {
        // empty
    }

    /**
     * @return Collection
     */
    public function getChildren()
    {
        return collect();
    }

    /**
     * @return int
     */
    public function getMatchProductCount()
    {
        return 0;
    }

    /**
     * @return bool
     */
    public function isSection()
    {
        return false;
    }

//    /**
//     * @param CatalogProductsFilterRequest $request
//     * @param Category $category
//     * @param FacetObjectInterface $facetObject
//     * @return AbstractFacetItem
//     */
//    public static function createCategoryFacetItem(CatalogProductsFilterRequest $request, Category $category, FacetObjectInterface $facetObject)
//    {
//        return (new self("category-{$category->id}"))
//            ->setTitle($category->name)
//            ->setAttributeName("category[{$category->id}]")
//            ->setIsMarked($request->isFilteredCategory($category->id))
//            ->setFacetObject($facetObject);
//    }
//
//    /**
//     * @param AttributeFacetItemObject $object
//     * @param FacetObjectInterface $facetObject
//     * @return AbstractFacetItem
//     */
//    public static function createAttributeFacetItem(AttributeFacetItemObject $object, FacetObjectInterface $facetObject)
//    {
//        return (new self($object->getItemKey()))
//            ->setTitle($object->getAttributeTitle())
//            ->setAttributeName($object->getHtmlName())
//            ->setIsMarked($object->getRequest()
//                ->isFilteredAttributeValue(
//                    $object->getAttributeName(),
//                    $object->getAttributeValue()
//                )
//            )
//            ->setFacetObject($facetObject);
//    }
}