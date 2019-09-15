<?php

namespace App\Services;

use App\Enums\ProductStatusEnum;
use App\Product;
use App\ProductStatus;
use Elasticsearch\ClientBuilder;

class ElasticSearchService
{
    /**
     * @var
     */
    private $client;

    public function __construct()
    {
        $this->client = ClientBuilder::create()->build();
    }

    /**
     * @param Product $product
     */
    public function indexProduct(Product $product)
    {
        $params = [
            "index" => env("ELASTIC_SEARCH_TEST_INDEX"),
            "type"  => "product",
            "id"    => $product->id,
            "body"  => $this->getIndexingBody($product)
        ];

        $this->client->index($params);
    }

    /**
     * @param $name
     * @return array
     */
    public function searchByName($name)
    {
        $params = [
            "index" => env("ELASTIC_SEARCH_TEST_INDEX"),
            "type"  => "product",
            "body"  => [
                "query" => [
                    "bool" => [
                        "must" => [
                            [
                                "match" => [
                                    "name" => $name
                                ]
                            ],
//                            [
//                                "term" => [
//                                    "status" => ProductStatus::find(ProductStatusEnum::AVAILABLE)->name
//                                ]
//                            ],
//                            [
//                                "range" => [
//                                    "quantity" => [
//                                        "gt" => 0
//                                    ]
//                                ]
//                            ]
                        ]
                    ]
                ]
            ]
        ];

        return $this->client->search($params);
    }

    /**
     * @param Product $product
     * @return mixed
     */
    private function getIndexingBody(Product $product)
    {
        $body = [
            "name"        => $product->name,
            "slug"        => $product->slug,
            "base_price"  => $product->base_price,
            "quantity"    => $product->quantity,
            "category"    => $product->category->name,
            "group"       => $product->group->name,
            "status"      => $product->status->name,
            "color"       => $product->color->name,
            "size"        => $product->size->name,
            "description" => $product->description,
            "properties"  => $this->getProductProperties($product),
            "images"      => $this->getProductImages($product)
        ];

        return $body;
    }

    /**
     * @param Product $product
     * @return array
     */
    private function getProductProperties(Product $product)
    {
        $properties = [];

        foreach ($product->propertyValues as $propertyValue) {
            $properties[] = [
                "id"       => $propertyValue->pivot->property_id,
                "name"     => $propertyValue->property->name,
                "value"    => $propertyValue->value,
                "ordering" => $propertyValue->pivot->ordering
            ];
        }

        return $properties;
    }

    /**
     * @param Product $product
     * @return array
     */
    private function getProductImages(Product $product)
    {
        $images = [];

        foreach ($product->images as $image) {
            $images[] = [
                "url"      => $image->url,
                "ordering" => $image->ordering,
                "main"     => $image->main,
                "preview"  => $image->preview,
            ];
        }

        return $images;
    }

}