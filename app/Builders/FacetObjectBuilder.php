<?php

namespace App\Builders;

use App\Builders\Interfaces\FacetObjectBuilderInterface;
use App\Category;
use App\Color;
use App\Components\Site\Api\Facet\AttributeFacetItem;
use App\Components\Site\Api\Facet\CategoryFacetItem;
use App\Components\Site\Api\Facet\FacetItem;
use App\Components\Site\Api\Facet\FacetObject;
use App\Components\Site\Api\Facet\Interfaces\FacetItemInterface;
use App\Components\Site\Api\Facet\Interfaces\FacetObjectInterface;
use App\Components\Site\Api\Facet\PropertyFacetItem;
use App\Components\Site\Api\Facet\SectionFacetItem;
use App\Http\Requests\Site\Api\CatalogProductsFilterRequest;
use App\Objects\AttributeFacetItemObject;
use App\Objects\PaginationObject;
use App\Objects\PriceRangeObject;
use App\Objects\PropertyFacetItemObject;
use App\Objects\SectionFacetItemObject;
use App\Product;
use App\Property;
use App\Size;

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
    public function addPriceRange(CatalogProductsFilterRequest $request)
    {
        $this->facetObject->setPriceRange((new PriceRangeObject())
            ->setMinPrice($request->getMinPrice())
            ->setMaxPrice($request->getMaxPrice())
        );
    }

    /**
     * @param CatalogProductsFilterRequest $request
     */
    public function addPaginator(CatalogProductsFilterRequest $request)
    {
        $this->facetObject->setPaginator((new PaginationObject())
            ->setCurrentPage($request->getPage())
        );
    }

    /**
     * @param CatalogProductsFilterRequest $request
     */
    public function addCategoriesItems(CatalogProductsFilterRequest $request)
    {
        $categorySection = (new SectionFacetItem('categories'))
            ->setTitle((new Product())->getFieldTranslation('category_id'))
            ->setAttributeName('')
            ->setIsMarked(false)
            ->setFacetObject($this->facetObject);

        foreach (Category::with('children')->whereNull('pid')->get() as $category) {
            $categorySection->addChildItem($this->getCategoryItem($request, $category));
        }

        $this->facetObject->addItem($categorySection);
    }

    /**
     * @param CatalogProductsFilterRequest $request
     */
    public function addAttributesItems(CatalogProductsFilterRequest $request)
    {
        $this->addColorsItems($request);
        $this->addSizesItems($request);
    }

    /**
     * @param CatalogProductsFilterRequest $request
     */
    public function addPropertiesItems(CatalogProductsFilterRequest $request)
    {
        foreach (Property::all() as $property) {
            $section = (new SectionFacetItem("property-{$property->id}"))
                ->setTitle($property->name)
                ->setAttributeName('')
                ->setIsMarked(false)
                ->setFacetObject($this->facetObject);

            foreach ($property->values as $propertyValue) {
                $section->addChildItem($this->getPropertyItem(
                    (new PropertyFacetItemObject())
                        ->setRequest($request)
                        ->setPropertyTitle($propertyValue->value)
                        ->setPropertyName("property-{$property->id}")
                        ->setPropertyValue($propertyValue->id)
                    )
                );
            }

            $this->facetObject->addItem($section);
        }
    }

    /**
     * @return FacetObject|FacetObjectInterface
     */
    public function getFacetObject()
    {
        return $this->facetObject;
    }



    # private section



    /**
     * @param CatalogProductsFilterRequest $request
     */
    private function addColorsItems(CatalogProductsFilterRequest $request)
    {
        $colorSection = (new SectionFacetItem('colors'))
            ->setTitle((new Product())->getFieldTranslation('color_id'))
            ->setAttributeName('')
            ->setIsMarked(false)
            ->setFacetObject($this->facetObject);

        foreach (Color::all() as $color) {
            $colorSection->addChildItem(
                $this->getAttributeItem((new AttributeFacetItemObject())
                    ->setRequest($request)
                    ->setAttributeTitle($color->name)
                    ->setAttributeName("color_id")
                    ->setAttributeValue($color->id)
                )
            );
        }

        $this->facetObject->addItem($colorSection);
    }

    /**
     * @param CatalogProductsFilterRequest $request
     */
    private function addSizesItems(CatalogProductsFilterRequest $request)
    {
        $sizeSection = (new SectionFacetItem('sizes'))
            ->setTitle((new Product())->getFieldTranslation('size_id'))
            ->setAttributeName('')
            ->setIsMarked(false)
            ->setFacetObject($this->facetObject);

        foreach (Size::all() as $size) {
            $sizeSection->addChildItem(
                $this->getAttributeItem((new AttributeFacetItemObject())
                    ->setRequest($request)
                    ->setAttributeTitle($size->name)
                    ->setAttributeName("size_id")
                    ->setAttributeValue($size->id)
                )
            );
        }

        $this->facetObject->addItem($sizeSection);
    }

    /**
     * @param CatalogProductsFilterRequest $request
     * @param $category
     * @return CategoryFacetItem
     */
    private function getCategoryItem(CatalogProductsFilterRequest $request, $category)
    {
        if ($request->isFilteredCategory($category->id)) {
            $this->facetObject->addFilteredCategory($category->id);
        }

        $facetItem = (new CategoryFacetItem("category-{$category->id}"))
            ->setTitle($category->name)
            ->setAttributeName("category[{$category->id}]")
            ->setIsMarked($request->isFilteredCategory($category->id))
            ->setFacetObject($this->facetObject); //$facetItem = FacetItem::createCategoryFacetItem($request, $category, $this->facetObject); // вынести из класса FacetItem

        foreach ($category->children as $childCategory) {
            $facetItem->addChildItem(
                $this->getCategoryItem($request, $childCategory)
            );
        }

        return $facetItem;
    }

    /**
     * @param AttributeFacetItemObject $object
     * @return AttributeFacetItem
     */
    private function getAttributeItem(AttributeFacetItemObject $object) //TODO дублирование кода получения айтема
    {
        if ($object->getRequest()->isFilteredAttributeValue($object->getAttributeName(), $object->getAttributeValue())) {
            $this->facetObject->addFilteredAttributeValue($object->getAttributeName(), $object->getAttributeValue());
        }

        return (new AttributeFacetItem($object->getItemKey()))
            ->setTitle($object->getAttributeTitle())
            ->setAttributeName($object->getHtmlName())
            ->setIsMarked($object->getRequest()->isFilteredAttributeValue($object->getAttributeName(), $object->getAttributeValue()))
            ->setFacetObject($this->facetObject);
    }

    /**
     * @param PropertyFacetItemObject $object
     * @return mixed
     */
    private function getPropertyItem(PropertyFacetItemObject $object) //TODO дублирование кода получения айтема
    {
        if ($object->getRequest()->isFilteredPropertyValue($object->getPropertyName(), $object->getPropertyValue())) {
            $this->facetObject->addFilteredPropertyValue($object->getPropertyName(), $object->getPropertyValue());
        }

        return (new PropertyFacetItem($object->getItemKey()))
            ->setTitle($object->getPropertyTitle())
            ->setAttributeName($object->getHtmlName())
            ->setIsMarked($object->getRequest()->isFilteredPropertyValue($object->getPropertyName(), $object->getPropertyValue()))
            ->setFacetObject($this->facetObject);
    }
}
