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
     * @param $key
     */
    public function setItemMarked($key);

    /**
     * @param $catId
     */
    public function addFilteredCategory($catId);

    /**
     * @return array
     */
    public function getFilteredCategories();

    /**
     * @param $attribute
     * @param $value
     */
    public function addFilteredAttributeValue($attribute, $value);

    /**
     * @param $attribute
     * @return array
     */
    public function getFilteredAttributeValues($attribute);

    /**
     * @param $property
     * @param $value
     */
    public function addFilteredPropertyValue($property, $value);

    /**
     * @param $property
     * @return array
     */
    public function getFilteredPropertyValues($property);

    /**
     * @return mixed
     */
    public function getSortingType();

    /**
     * @param $type
     * @return $this
     */
    public function setSortingType($type);

    /**
     * @return mixed
     */
    public function getProducts(); //TODO сомнительные функции, подумать

    /**
     * @return mixed
     */
    public function getProductsCount(); //TODO сомнительные функции, подумать
}
