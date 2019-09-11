<?php

namespace App\Services\Site\Interfaces;

use App\Components\Site\Api\Facet\Interfaces\FacetObjectInterface;

interface ProductsSearchServiceInterface
{
    /**
     * @param FacetObjectInterface $facetObject
     * @return mixed
     */
    public function getProductCount(FacetObjectInterface $facetObject);

    /**
     * @param FacetObjectInterface $facetObject
     * @return mixed
     */
    public function search(FacetObjectInterface $facetObject);
}
