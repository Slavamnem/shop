<?php

namespace App\Services\Admin\Interfaces;

use App\Http\Requests\Admin\ShareRequest;
use App\Product;
use App\Share;

interface ShareServiceInterface
{
    /**
     * @param Share $share
     * @param ShareRequest $request
     * @return mixed|void
     */
    public function setConditions(Share $share, ShareRequest $request);

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