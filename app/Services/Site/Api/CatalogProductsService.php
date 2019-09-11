<?php

namespace App\Services\Site\Api;

use App\Builders\FacetObjectBuilder;
use App\Components\Site\Api\Facet\FacetObject;
use App\Http\Requests\Site\Api\CatalogProductsFilterRequest;
use App\Services\Site\Interfaces\CatalogProductsServiceInterface;

class CatalogProductsService implements CatalogProductsServiceInterface
{
    /**
     * @param CatalogProductsFilterRequest $request
     * @return FacetObject
     */
    public function buildFacetObject(CatalogProductsFilterRequest $request)
    {
        //dump($request->getRequestData()); //dump($request->getFilteredCategories());
        $facetObjectBuilder = FacetObjectBuilder::create();
        $facetObjectBuilder->setPriceRange($request);
        $facetObjectBuilder->setPaginator($request);
        $facetObjectBuilder->setCategoriesItems($request);

        return $facetObjectBuilder->getFacetObject();
    }
}
