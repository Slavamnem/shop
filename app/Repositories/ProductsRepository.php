<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 31.12.2019
 * Time: 0:45
 */

namespace App\Repositories;

use App\Http\Requests\Admin\Stock\ChangeProductQuantityRequest;
use App\Objects\TimePeriodObject;
use App\Product;

interface ProductsRepository extends Repository
{
    /**
     * @param $id
     * @return Product
     */
    public function getProductById($id) : Product;

    /**
     * @return Product[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllProducts();

    /**
     * @return Product[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllProductsArray();

    /**
     * @param int $count
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getLastProducts($count = 10);

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function getProductWithOrders($id);

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getProductsWithSalesStats();

    /**
     * @param $column
     */
    public function getProductsWithSalesStatsOrderByDesc($column);

    /**
     * @param TimePeriodObject $timePeriodObject
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function getProductsWithSalesStatsByPeriod(TimePeriodObject $timePeriodObject);

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public function getProductsWithSalesStatsQuery();

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getFullProductQuery();

    /**
     * @param ChangeProductQuantityRequest $request
     */
    public function updateProductQuantity(ChangeProductQuantityRequest $request);
}
