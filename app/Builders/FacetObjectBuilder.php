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
    /**
     * @var CatalogProductsFilterRequest
     */
    private $catalogProductsFilterRequest;

    /**
     * FacetObjectBuilder constructor.
     */
    public function __construct()
    {
        $this->facetObject = new FacetObject();
    }

    /**
     * @param CatalogProductsFilterRequest $catalogProductsFilterRequest
     * @return FacetObjectBuilderInterface
     */
    public function setCatalogProductsFilterRequest(CatalogProductsFilterRequest $catalogProductsFilterRequest)
    {
        $this->catalogProductsFilterRequest = $catalogProductsFilterRequest;
        return $this;
    }

    /**
     * @return FacetObjectBuilderInterface
     */
    public function setSortingType()
    {
        $this->facetObject->setSortingType($this->catalogProductsFilterRequest->getSortingType());
        return $this;
    }

    /**
     * @return FacetObjectBuilderInterface
     */
    public function setPriceRange()
    {
        $this->facetObject->setPriceRange((new PriceRangeObject())
            ->setMinPrice($this->catalogProductsFilterRequest->getMinPrice())
            ->setMaxPrice($this->catalogProductsFilterRequest->getMaxPrice())
        );

        return $this;
    }

    /**
     * @return FacetObjectBuilderInterface
     */
    public function setPagination()
    {
        $this->facetObject->setPaginator((new PaginationObject())
            ->setCurrentPage($this->catalogProductsFilterRequest->getPage())
        );

        return $this;
    }

    /**
     * @return FacetObjectBuilderInterface
     */
    public function setCategoriesItems()
    {
        $categorySection = (new SectionFacetItem('categories'))
            ->setTitle((new Product())->getFieldTranslation('category_id'))
            ->setAttributeName('')
            ->setIsMarked(false)
            ->setFacetObject($this->facetObject);

        foreach (Category::with('children')->whereNull('pid')->get() as $category) {
            $categorySection->addChildItem($this->getCategoryItem($this->catalogProductsFilterRequest, $category)); //TODO adapter
        }

        $this->facetObject->addItem($categorySection);

        return $this;
    }

    /**
     * @return FacetObjectBuilderInterface
     */
    public function setAttributesItems()
    {
        return $this
            ->addColorsItems()
            ->addSizesItems();
    }

    /**
     * @return FacetObjectBuilderInterface
     */
    public function setPropertiesItems()
    {
        foreach (Property::all() as $property) {
            $section = (new SectionFacetItem("property-{$property->id}"))
                ->setTitle($property->name)
                ->setAttributeName('')
                ->setIsMarked(false)
                ->setFacetObject($this->facetObject);

            foreach ($property->values as $propertyValue) {
                $section->addChildItem($this->getPropertyItem( //TODO adapter
                    (new PropertyFacetItemObject())
                        ->setRequest($this->catalogProductsFilterRequest)
                        ->setPropertyTitle($propertyValue->value)
                        ->setPropertyName("property-{$property->id}")
                        ->setPropertyValue($propertyValue->id)
                    )
                );
            }

            $this->facetObject->addItem($section);
        }

        return $this;
    }

    /**
     * @return FacetObjectInterface
     */
    public function getFacetObject()
    {
        return $this->facetObject;
    }



    # private section


    /**
     * @return $this
     */
    private function addColorsItems()
    {
        $colorSection = (new SectionFacetItem('colors'))
            ->setTitle((new Product())->getFieldTranslation('color_id'))
            ->setAttributeName('')
            ->setIsMarked(false)
            ->setFacetObject($this->facetObject);

        foreach (Color::all() as $color) {
            $colorSection->addChildItem(
                $this->getAttributeItem((new AttributeFacetItemObject()) //TODO adapter
                    ->setRequest($this->catalogProductsFilterRequest)
                    ->setAttributeTitle($color->name)
                    ->setAttributeName("color_id")
                    ->setAttributeValue($color->id)
                )
            );
        }

        $this->facetObject->addItem($colorSection);

        return $this;
    }

    /**
     * @return $this
     */
    private function addSizesItems()
    {
        $sizeSection = (new SectionFacetItem('sizes'))
            ->setTitle((new Product())->getFieldTranslation('size_id'))
            ->setAttributeName('')
            ->setIsMarked(false)
            ->setFacetObject($this->facetObject);

        foreach (Size::all() as $size) {
            $sizeSection->addChildItem(
                $this->getAttributeItem((new AttributeFacetItemObject()) //TODO adapter
                    ->setRequest($this->catalogProductsFilterRequest)
                    ->setAttributeTitle($size->name)
                    ->setAttributeName("size_id")
                    ->setAttributeValue($size->id)
                )
            );
        }

        $this->facetObject->addItem($sizeSection);

        return $this;
    }

    /**
     * @param CatalogProductsFilterRequest $request
     * @param $category
     * @return CategoryFacetItem
     */
    private function getCategoryItem(CatalogProductsFilterRequest $request, $category) //TODO strategy
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
