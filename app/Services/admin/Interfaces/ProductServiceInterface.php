<?php

namespace App\Services\Admin\Interfaces;

use App\Builders\Interfaces\DocumentBuilderInterface;
use App\Components\Interfaces\SaveDataToFileInterface;
use App\Http\Requests\Admin\ProductRequest;
use App\ModelGroup;
use App\Product;
use App\Services\RestApi\Interfaces\ImageStorageServiceInterface;
use Illuminate\Http\Request;

interface ProductServiceInterface
{
    /**
     * ProductServiceInterface constructor.
     * @param Request $request
     * @param ShareServiceInterface $shareService
     * @param ImageStorageServiceInterface $imageStorageService
     */
    public function __construct(Request $request, ShareServiceInterface $shareService, ImageStorageServiceInterface $imageStorageService);

    /**
     * Get data for products views
     *
     * @param $id
     * @return array
     */
    public function getData($id = null);

    /**
     * @param Product $product
     * @param ProductRequest $request
     */
    public function saveImages(Product $product, ProductRequest $request);

    /**
     * @param Product $product
     * @param ProductRequest $request
     * @return mixed
     */
    public function saveProperties(Product $product, ProductRequest $request);

    /**
     * Store chose product modifications for new group
     *
     * @param  ModelGroup $group
     */
    public function createModifications(ModelGroup $group);

    /**
     * @param DocumentBuilderInterface $builder
     * @param $data
     * @param $fileName
     * @return mixed
     */
    public function saveToFile(DocumentBuilderInterface $builder, $data, $fileName);
}