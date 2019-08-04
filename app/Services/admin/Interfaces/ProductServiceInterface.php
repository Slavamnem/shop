<?php

namespace App\Services\Admin\Interfaces;

use App\Builders\Interfaces\DocumentBuilderInterface;
use App\Components\Interfaces\SaveDataToFileInterface;
use App\ModelGroup;
use App\Product;
use Illuminate\Http\Request;

interface ProductServiceInterface
{

    /**
     * ProductServiceInterface constructor.
     * @param Request $request
     */
    public function __construct(Request $request);

    /**
     * Get data for products views
     *
     * @param $id
     * @return array
     */
    public function getData($id = null);

    /**
     * @param Product $product
     */
    public function saveImages(Product $product);

    /**
     * @param Product $product
     * @return mixed
     */
    public function saveProperties(Product $product);

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

    /**
     * @return mixed
     */
    public function getConditionsFields();
}