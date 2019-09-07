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
    public function testGetFilteredProducts(CatalogProductsFilterRequest $request)
    {
        $facetObject = $this->service->getFilteredProducts($request);
        return [
            'products' => view('site.catalog.filtered_products', ['products' => $facetObject->getProducts()])->render(),
            'facet' => view('site.catalog.filtered_facet', ['facetObject' => $facetObject])->render()
        ];

        //return view('site.catalog.filtered_products', ['products' => $this->service->getFilteredProducts($request)])->render();
    }

    public function getFilteredProducts()
    {
        $facetObject = (new FacetObject())
            ->setPriceRange((new PriceRangeObject())
                ->setMinPrice($this->request->input('minPrice', 0))
                ->setMaxPrice($this->request->input('maxPrice'))
            )
            ->setPaginator((new PaginationObject())
                ->setCurrentPage($this->request->input('page', 1))
        );

        foreach (Category::with('children')->whereNull('pid')->get() as $catId => $category) {
            $isMarked = in_array($category->id, array_keys($this->request->input('categories')));

            $facetItem = (new FacetItem())->setTitle($category->name)->setIsMarked($isMarked);

            foreach ($category->children as $childCategory) {
                $isMarked = in_array($childCategory->id, array_keys($this->request->input('categories')));

                $facetItem->addChildItem((new FacetItem())
                    ->setTitle($childCategory->name)
                    ->setIsMarked($isMarked));
            }

            $facetObject->addItem($facetItem);
        }

        $selectedCategories = $this->request->categories;
        $selectedAttributes = [];
        $selectedProperties = [];

        dump($facetObject);
    }
}