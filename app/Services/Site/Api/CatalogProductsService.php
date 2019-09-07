<?php

namespace App\Services\Site\Api;

use App\Category;
use App\Components\Site\Api\Facet\FacetItem;
use App\Components\Site\Api\Facet\FacetObject;
use App\Http\Requests\Site\Api\CatalogProductsFilterRequest;
use App\Objects\PaginationObject;
use App\Objects\PriceRangeObject;
use App\Product;
use App\Services\Site\Api\Search\DbProductsSearchService;
use App\Services\Site\Interfaces\CatalogProductsServiceInterface;

class CatalogProductsService implements CatalogProductsServiceInterface
{
    /**
     * @param CatalogProductsFilterRequest $request
     * @return mixed
     */
    public function getFilteredProducts(CatalogProductsFilterRequest $request)
    {
        //dump($request->getRequestData());
        //dump($request->getFilteredCategories());


        $facetObject = (new FacetObject())
            ->setPriceRange((new PriceRangeObject())
                ->setMinPrice($request->getMinPrice())
                ->setMaxPrice($request->getMaxPrice())
            )
            ->setPaginator((new PaginationObject())
                ->setCurrentPage($request->getPage())
            );

        foreach (Category::with('children')->whereNull('pid')->get() as $catId => $category) {
            $isMarked = in_array($category->id, $request->getFilteredCategories());

            if ($isMarked) $facetObject->addFilteredCategory($category->id);

            $facetItem = (new FacetItem())
                ->setTitle($category->name)
                ->setAttributeName("category[{$category->id}]")
                ->setIsMarked($isMarked);

            foreach ($category->children as $childCategory) {
                if ($isMarked) {
                    $subIsMarked = true;
                } else {
                    $subIsMarked = in_array($childCategory->id, $request->getFilteredCategories());
                }

                if ($subIsMarked) $facetObject->addFilteredCategory($childCategory->id);

                $facetItem->addChildItem((new FacetItem())
                    ->setTitle($childCategory->name)
                    ->setAttributeName("category[{$childCategory->id}]")
                    ->setIsMarked($subIsMarked));
            }

            $facetObject->addItem($facetItem);
        }

        //dump($facetObject);

        return $facetObject;
        //////////////////////
        $products = Product::query()->orderBy('category_id')->get();
        $products = (new DbProductsSearchService($facetObject))->search();

        return $products;
    }
}
