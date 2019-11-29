<?php

namespace App\Builders\Interfaces;

use App\Components\Site\Api\Facet\FacetObject;
use App\Components\Site\Api\Facet\Interfaces\FacetObjectInterface;
use App\Http\Requests\Site\Api\CatalogProductsFilterRequest;

interface FacetObjectBuilderInterface
{
    /**
     * @param CatalogProductsFilterRequest $catalogProductsFilterRequest
     * @return FacetObjectBuilderInterface
     */
    public static function create(CatalogProductsFilterRequest $catalogProductsFilterRequest);

    /**
     * @return $this
     */
    public function setSortingType();

    /**
     * @return $this
     */
    public function setPriceRange();

    /**
     * @return $this
     */
    public function setPagination();

    /**
     * @return $this
     */
    public function setCategoriesItems();

    /**
     * @return $this
     */
    public function setAttributesItems();

    /**
     * @return $this
     */
    public function setPropertiesItems();

    /**
     * @return FacetObject|FacetObjectInterface
     */
    public function getFacetObject();
}
