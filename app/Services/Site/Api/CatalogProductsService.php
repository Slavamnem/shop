<?php

namespace App\Services\Site\Api;

use App\Builders\FacetObjectBuilder;
use App\Components\Site\Api\Facet\FacetObject;
use App\Components\Site\Api\Facet\Interfaces\FacetObjectInterface;
use App\Http\Requests\Site\Api\CatalogProductsFilterRequest;
use App\Services\Site\Interfaces\CatalogProductsServiceInterface;

class CatalogProductsService implements CatalogProductsServiceInterface
{
    /**
     * @param CatalogProductsFilterRequest $request
     * @return FacetObjectInterface
     */
    public function buildFacetObject(CatalogProductsFilterRequest $request)
    {
        //dump($request->getRequestData()); //dump($request->getFilteredCategories());
        return FacetObjectBuilder::create($request)
            ->setSortingType()
            ->setPriceRange()
            ->setPagination()
            ->setCategoriesItems()
            ->setAttributesItems()
            ->setPropertiesItems()
            ->getFacetObject();
    }
}
