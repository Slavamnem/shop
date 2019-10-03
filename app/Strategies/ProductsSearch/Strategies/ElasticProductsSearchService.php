<?php

namespace App\Strategies\ProductsSearch\Strategies;

use App\Product;
use App\Property;
use App\Services\ElasticSearchService;
use App\Services\Site\Interfaces\ElasticSearchServiceInterface;
use App\Services\Site\Interfaces\ProductsSearchServiceInterface;

class ElasticProductsSearchService extends AbstractProductsSearchService implements ProductsSearchServiceInterface
{
    /**
     * @var
     */
    private $queryParams;
    /**
     * @var ElasticSearchServiceInterface
     */
    private $elasticService;

    public function __construct()
    {
        $this->elasticService = resolve(ElasticSearchServiceInterface::class);
        parent::__construct();
    }

    public function initQuery()
    {
        $this->queryParams = [
            'index' => 'product',
            'body' => [
                'size' => element('products_per_page'),
                '_source' => $this->elasticService->getProductSource()
            ]
        ];
    }

    /**
     * @return mixed
     */
    public function getCountQueryResult()
    {

    }

    /**
     * @return mixed
     */
    public function getSearchQueryResult()
    {
        return $this->elasticService->searchByQuery($this->queryParams)['hits']['hits'];//['hits']['hits'][0]['_source'];
        dd($this->elasticService->searchByQuery($this->queryParams));
    }

    public function addPriceConditions()
    {
        $this->queryParams['body']['query']['bool']['must'][] = [
            'range' => [
                'base_price' => [
                    'gte' => $this->facetObject->getPriceRange()->getMinPrice(),
                    'lte' => $this->facetObject->getPriceRange()->getMaxPrice()
                ]
             ]
        ];
    }

    public function addCategoryConditions()
    {
        if ($this->facetObject->getFilteredCategories()) {
            $this->queryParams['body']['query']['bool']['must'][] = [
                'terms' => [
                    'category.id' => $this->facetObject->getFilteredCategories()
                ]
            ];
        }
    }

    public function addAttributesConditions()
    {
        foreach (Product::FACET_ATTRIBUTES as $attribute) {
           // dump($attribute);
          //  dump($this->facetObject->getFilteredAttributeValues($attribute));
            if ($this->facetObject->getFilteredAttributeValues($attribute)) {
               // dd(1);
                $elasticAttribute = str_replace("_", ".", $attribute);
                $this->queryParams['body']['query']['bool']['must'][] = [
                    'terms' => [
                        $elasticAttribute => $this->facetObject->getFilteredAttributeValues($attribute)
                    ]
                ];
            }
        }
    }

    public function addPropertiesConditions()
    {
        foreach (Property::all() as $property) {
            if ($this->facetObject->getFilteredPropertyValues("property-{$property->id}") or $property->id == 1) {
                $this->queryParams['body']['query']['bool']['must'][] = [
                    'terms' => [
                        'properties.0.' => $this->facetObject->getFilteredPropertyValues("property-{$property->id}")
                    ]
                ];

//                $this->query = $this->query->whereHas("propertyValues", function($query) use($property){
//                    $query->where("property_values.property_id", $property->id)
//                        ->whereIn("property_values.id", $this->facetObject->getFilteredPropertyValues("property-{$property->id}"));
//                });
            }
        }
    }

    public function sortProducts()
    {
        $this->queryParams['body']['sort'] = ['base_price' => ['order' => 'desc']];
    }

    /**
     * @param $limit
     */
    public function addLimit($limit)
    {
        $this->queryParams['body']['size'] = $limit;
    }
}
