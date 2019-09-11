<?php

namespace App\Services\Site\Interfaces;

use App\Http\Requests\Site\Api\CatalogProductsFilterRequest;

interface CatalogProductsServiceInterface
{
    /**
     * @param CatalogProductsFilterRequest $request
     * @return mixed
     */
    public function buildFacetObject(CatalogProductsFilterRequest $request);
}