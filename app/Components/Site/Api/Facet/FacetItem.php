<?php

namespace App\Components\Site\Api\Facet;

use App\Category;
use App\Components\Site\Api\Facet\Interfaces\FacetItemInterface;
use App\Components\Site\Api\Facet\Interfaces\FacetObjectInterface;
use App\Http\Requests\Site\Api\CatalogProductsFilterRequest;
use App\Strategies\FacetItem\FacetItemStrategy;
use App\Strategies\Interfaces\StrategyInterface;
use Illuminate\Support\Collection;

class FacetItem implements FacetItemInterface
{
    /**
     * @var string
     */
    private $key;
    /**
     * @var string
     */
    private $title;
    /**
     * @var attribute name in html checkbox
     */
    private $attributeName;
    /**
     * @var bool
     */
    private $isMarked;
    /**
     * @var Collection
     */
    private $childrenItems;
    /**
     * @var FacetObjectInterface
     */
    private $facetObject;
    /**
     * @var StrategyInterface
     */
    private $facetItemStrategy;

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

    public function mark()
    {
        $this->isMarked = true;
    }

    public function unMark()
    {
        $this->isMarked = false;
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
     * @return int
     */
    public function getMatchProductCount()
    {
        return $this->facetItemStrategy->getStrategy('category')->getMatchProductCount($this);
    }

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

    //

    /**
     * @param CatalogProductsFilterRequest $request
     * @param Category $category
     * @param FacetObjectInterface $facetObject
     * @return FacetItem
     */
    public static function createCategoryFacetItem(CatalogProductsFilterRequest $request, Category $category, FacetObjectInterface $facetObject)
    {
        return (new self("category-{$category->id}"))
            ->setTitle($category->name)
            ->setAttributeName("category[{$category->id}]")
            ->setIsMarked($request->isFilteredCategory($category->id))
            ->setFacetObject($facetObject);
    }
}
