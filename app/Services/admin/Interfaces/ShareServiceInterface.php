<?php

namespace App\Services\Admin\Interfaces;

use App\Product;
use App\Share;

interface ShareServiceInterface
{
    /**
     * @param Share $share
     * @return mixed
     */
    public function setConditions(Share $share);

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getFilteredShares();

    /**
     * @param Product $product
     * @return mixed
     */
    public function getProductShare(Product $product);

    /**
     * @param Product $product
     * @return array
     */
    public function getProductShares(Product $product);

    /**
     * @param Product $product
     * @param Share $share
     * @return bool
     */
    public function productHasShare(Product $product, Share $share);
}