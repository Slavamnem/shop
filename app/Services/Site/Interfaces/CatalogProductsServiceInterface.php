<?php

namespace App\Services\Site\Interfaces;

use App\Components\Site\Api\Facet\Interfaces\FacetObjectInterface;
use App\Http\Requests\Site\Api\CatalogProductsFilterRequest;

interface CatalogProductsServiceInterface
{
    /**
     * @param CatalogProductsFilterRequest $request
     * @return FacetObjectInterface
     */
    public function buildFacetObject(CatalogProductsFilterRequest $request);
}