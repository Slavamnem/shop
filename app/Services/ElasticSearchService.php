<?php

namespace App\Services;

use App\Enums\ProductStatusEnum;
use App\Product;
use App\ProductStatus;
use App\Services\Site\Interfaces\ElasticSearchServiceInterface;
use Carbon\Carbon;
use Elasticsearch\ClientBuilder;

class ElasticSearchService implements ElasticSearchServiceInterface
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
            "index" => 'product',//env("ELASTIC_SEARCH_TEST_INDEX"),
            "id"    => $product->id,
            "body"  => $this->getIndexingBody($product)
        ];

        $this->client->index($params);
    }

    /**
     * @param $params
     * @return array|callable
     */
    public function searchByQuery($params)
    {
        return $this->client->search($params);
    }

    /**
     * @return array
     */
    public function getProductSource()
    {
        return [
            'name',
            'slug',
            'base_price',
            'quantity',
            'category',
            'size',
            'color',
            'properties'
        ];
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
            "category"    => $this->getProductCategory($product),
            "model"       => $this->getProductModel($product),
            "status"      => $product->status->name,
            "color"       => $this->getProductColor($product),
            "size"        => $this->getProductSize($product),
            "description" => $product->description,
            "created_at"  => Carbon::parse($product->created_at)->toDateTimeString(),
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

    /**
     * @param Product $product
     * @return array
     */
    private function getProductCategory(Product $product)
    {
        return [
            "id"       => $product->category->id,
            "pid"      => $product->category->pid,
            "name"     => $product->category->name,
            "slug"     => $product->category->slug,
            "ordering" => $product->category->ordering,
        ];
    }

    /**
     * @param Product $product
     * @return array
     */
    private function getProductModel(Product $product)
    {
        return [
            "id"   => $product->group->id,
            "name" => $product->group->name,
        ];
    }

    /**
     * @param Product $product
     * @return array
     */
    private function getProductColor(Product $product)
    {
        return [
            "id"   => $product->color->id,
            "name" => $product->color->name,
        ];
    }

    /**
     * @param Product $product
     * @return array
     */
    private function getProductSize(Product $product)
    {
        return [
            "id"   => $product->size->id,
            "name" => $product->size->name,
        ];
    }
}
