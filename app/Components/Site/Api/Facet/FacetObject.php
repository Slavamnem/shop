<?php

namespace App\Components\Site\Api\Facet;

use App\Components\Site\Api\Facet\Interfaces\FacetItemInterface;
use App\Components\Site\Api\Facet\Interfaces\FacetObjectInterface;
use App\Objects\Interfaces\PaginationObjectInterface;
use App\Objects\PriceRangeObject;
use App\Services\Site\Api\Search\DbProductsSearchService;
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
        $this->facetItems->push($item);
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

    /**
     * @param $catId
     */
    public function addFilteredCategory($catId)
    {
        $this->filteredCategories->push($catId);
    }

    /**
     * @return array
     */
    public function getFilteredCategories()
    {
        return $this->filteredCategories->toArray();
    }

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return (new DbProductsSearchService($this))->search();
    }
}
