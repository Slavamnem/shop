<?php

namespace App\Components\Site\Api\Facet\Interfaces;

use App\Objects\Interfaces\PaginationObjectInterface;
use App\Objects\PriceRangeObject;
use Illuminate\Support\Collection;

interface FacetObjectInterface
{
    /**
     * @param FacetItemInterface $item
     */
    public function addItem(FacetItemInterface $item);

    /**
     * @return Collection
     */
    public function getItems();

    /**
     * @return PaginationObjectInterface
     */
    public function getPaginator();

    /**
     * @param PriceRangeObject $object
     * @return $this
     */
    public function setPriceRange(PriceRangeObject $object);

    /**
     * @return PriceRangeObject
     */
    public function getPriceRange();

    /**
     * @param $catId
     */
    public function addFilteredCategory($catId);

    /**
     * @return array
     */
    public function getFilteredCategories();
}
