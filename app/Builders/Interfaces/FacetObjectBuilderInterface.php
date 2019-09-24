<?php

namespace App\Builders\Interfaces;

use App\Components\Site\Api\Facet\FacetObject;
use App\Components\Site\Api\Facet\Interfaces\FacetObjectInterface;
use App\Http\Requests\Site\Api\CatalogProductsFilterRequest;

interface FacetObjectBuilderInterface
{
    /**
     * @return FacetObjectBuilderInterface
     */
    public static function create();

    /**
     * @param CatalogProductsFilterRequest $request
     */
    public function setSortingType(CatalogProductsFilterRequest $request);

    /**
     * @param CatalogProductsFilterRequest $request
     */
    public function addPriceRange(CatalogProductsFilterRequest $request);

    /**
     * @param CatalogProductsFilterRequest $request
     */
    public function addPaginator(CatalogProductsFilterRequest $request);

    /**
     * @param CatalogProductsFilterRequest $request
     */
    public function addCategoriesItems(CatalogProductsFilterRequest $request);

    /**
     * @param CatalogProductsFilterRequest $request
     */
    public function addAttributesItems(CatalogProductsFilterRequest $request);

    /**
     * @param CatalogProductsFilterRequest $request
     */
    public function addPropertiesItems(CatalogProductsFilterRequest $request);

    /**
     * @return FacetObject|FacetObjectInterface
     */
    public function getFacetObject();
}
