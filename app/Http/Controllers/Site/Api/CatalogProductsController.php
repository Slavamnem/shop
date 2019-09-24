<?php

namespace App\Http\Controllers\Site\Api;

use App\Category;
use App\Components\Site\Api\Facet\FacetItem;
use App\Components\Site\Api\Facet\FacetObject;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\Api\CatalogProductsFilterRequest;
use App\Objects\PaginationObject;
use App\Objects\PriceRangeObject;
use App\Product;
use App\Services\Site\Interfaces\CatalogProductsServiceInterface;
use Illuminate\Http\Request;

class CatalogProductsController extends Controller
{
    /**
     * @var
     */
    private $request;
    /**
     * @var CatalogProductsServiceInterface
     */
    private $service;

    /**
     * CatalogProductsController constructor.
     * @param Request $request
     * @param CatalogProductsServiceInterface $service
     */
    public function __construct(Request $request, CatalogProductsServiceInterface $service)
    {
        $this->request = $request;
        $this->service = $service;
    }

    /**
     * @param CatalogProductsFilterRequest $request
     * @return array
     * @throws \Throwable
     */
    public function getCatalogData(CatalogProductsFilterRequest $request)
    {
        $facetObject = $this->service->buildFacetObject($request);

        return [
            'products' => view('site.catalog.filtered_products', ['sorting' => $facetObject->getSortingType(), 'products' => $facetObject->getProducts()])->render(),
            'facet' => view('site.catalog.filtered_facet', ['facetObject' => $facetObject])->render()
        ];

        //return view('site.catalog.filtered_products', ['products' => $this->service->getFilteredProducts($request)])->render();
    }
}