<?php

namespace App\Services\Admin\Interfaces;

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
     * Store chose product modifications for new group
     *
     * @param  ModelGroup $group
     */
    public function createModifications(ModelGroup $group);
}