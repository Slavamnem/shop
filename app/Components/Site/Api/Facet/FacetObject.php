<?php

namespace App\Components\Site\Api\Facet;

use App\Category;
use App\Components\Site\Api\Facet\Interfaces\FacetItemInterface;
use App\Components\Site\Api\Facet\Interfaces\FacetObjectInterface;
use App\Objects\Interfaces\PaginationObjectInterface;
use App\Objects\PriceRangeObject;
use App\Strategies\Interfaces\StrategyInterface;
use App\Strategies\ProductsSearch\ProductsSearchStrategy;
use Illuminate\Support\Collection;

class FacetObject implements FacetObjectInterface
{
    /**
     * @var Collection
     */
    private $facetItems;

    /**
     * @var Collection
     */
    private $filteredCategories;

    /**
     * @var PaginationObjectInterface
     */
    private $paginator;

    /**
     * @var PriceRangeObject
     */
    private $priceRange;

    /**
     * @var StrategyInterface
     */
    private $productSearchStrategy;

    public function __construct()
    {
        $this->facetItems = collect();
        $this->filteredCategories = collect();
    }

    /**
     * @param FacetItemInterface $item
     */
    public function addItem(FacetItemInterface $item)
    {
        $this->facetItems->put($item->getKey(), $item);
    }

    /**
     * @param $key
     */
    public function setItemMarked($key)
    {
        $this->facetItems->get($key)->mark();
    }

    /**
     * @return Collection
     */
    public function getItems()
    {
        return $this->facetItems;
    }

    /**
     * @param PaginationObjectInterface $paginator
     * @return $this
     */
    public function setPaginator(PaginationObjectInterface $paginator)
    {
        $this->paginator = $paginator;
        return $this;
    }

    /**
     * @return PaginationObjectInterface
     */
    public function getPaginator()
    {
        return $this->paginator;
    }

    /**
     * @param PriceRangeObject $object
     * @return $this
     */
    public function setPriceRange(PriceRangeObject $object)
    {
        $this->priceRange = $object;
        return $this;
    }

    /**
     * @return PriceRangeObject
     */
    public function getPriceRange()
    {
        return $this->priceRange;
    }

    ///////////////////////////////////

    /**
     * @param $catId
     */
    public function addFilteredCategory($catId) //TODO strategy
    {
        $this->filteredCategories->push($catId);
        $this->addToFilteredSubCategories($catId);
    }

    /**
     * @param $catId
     */
    private function addToFilteredSubCategories($catId)
    {
        foreach (Category::where('pid', $catId)->get() as $subCategory) {
            $this->filteredCategories->push($subCategory->id);
            $this->addToFilteredSubCategories($subCategory->id);
        }
    }

    /**
     * @return array
     */
    public function getFilteredCategories() //TODO strategy
    {
        return $this->filteredCategories->toArray();
    }

    /////////////////////////////////////////////

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return $this->getProductsSearchStrategy()->getStrategy('db')->search($this);
    }

    /**
     * @return mixed
     */
    public function getProductsCount()
    {
        return $this->getProductsSearchStrategy()->getStrategy('db')->getProductCount($this);
    }

    /**
     * @return ProductsSearchStrategy
     */
    private function getProductsSearchStrategy()
    {
        return new ProductsSearchStrategy();
    }
}
