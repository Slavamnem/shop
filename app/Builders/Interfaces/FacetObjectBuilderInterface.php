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
    public function setPriceRange(CatalogProductsFilterRequest $request);

    /**
     * @param CatalogProductsFilterRequest $request
     */
    public function setPaginator(CatalogProductsFilterRequest $request);

    /**
     * @param CatalogProductsFilterRequest $request
     */
    public function setCategoriesItems(CatalogProductsFilterRequest $request);

    /**
     * @return FacetObject|FacetObjectInterface
     */
    public function getFacetObject();
}
