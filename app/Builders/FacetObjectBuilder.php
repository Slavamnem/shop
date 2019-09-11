<?php

namespace App\Builders;

use App\Builders\Interfaces\FacetObjectBuilderInterface;
use App\Category;
use App\Components\Site\Api\Facet\FacetItem;
use App\Components\Site\Api\Facet\FacetObject;
use App\Components\Site\Api\Facet\Interfaces\FacetItemInterface;
use App\Components\Site\Api\Facet\Interfaces\FacetObjectInterface;
use App\Http\Requests\Site\Api\CatalogProductsFilterRequest;
use App\Objects\PaginationObject;
use App\Objects\PriceRangeObject;

class FacetObjectBuilder implements FacetObjectBuilderInterface
{
    /**
     * @var FacetObjectInterface
     */
    private $facetObject;

    private function __construct()
    {
        $this->facetObject = new FacetObject();
    }

    /**
     * @return FacetObjectBuilderInterface
     */
    public static function create()
    {
        return new self();
    }

    /**
     * @param CatalogProductsFilterRequest $request
     */
    public function setPriceRange(CatalogProductsFilterRequest $request)
    {
        $this->facetObject->setPriceRange((new PriceRangeObject())
            ->setMinPrice($request->getMinPrice())
            ->setMaxPrice($request->getMaxPrice())
        );
    }

    /**
     * @param CatalogProductsFilterRequest $request
     */
    public function setPaginator(CatalogProductsFilterRequest $request)
    {
        $this->facetObject->setPaginator((new PaginationObject())
            ->setCurrentPage($request->getPage())
        );
    }

    /**
     * @param CatalogProductsFilterRequest $request
     */
    public function setCategoriesItems(CatalogProductsFilterRequest $request)
    {
        foreach (Category::with('children')->whereNull('pid')->get() as $category) {
            $this->facetObject->addItem($this->getCategoryItem($request, $category));
        }
    }

    /**
     * @return FacetObject|FacetObjectInterface
     */
    public function getFacetObject()
    {
        return $this->facetObject;
    }

    /**
     * @param CatalogProductsFilterRequest $request
     * @param $category
     * @return FacetItem
     */
    private function getCategoryItem(CatalogProductsFilterRequest $request, $category)
    {
        if ($request->isFilteredCategory($category->id)) {
            $this->facetObject->addFilteredCategory($category->id);
        }

        $facetItem = FacetItem::createCategoryFacetItem($request, $category, $this->facetObject);

        foreach ($category->children as $childCategory) {
            $facetItem->addChildItem(
                $this->getCategoryItem($request, $childCategory)
            );
        }

        return $facetItem;
    }
}
