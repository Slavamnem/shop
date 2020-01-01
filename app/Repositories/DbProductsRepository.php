<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 31.12.2019
 * Time: 0:45
 */

namespace App\Repositories;

use App\Http\Requests\Admin\Filter\EntityFilterRequest;
use App\Http\Requests\Admin\Stock\ChangeProductQuantityRequest;
use App\Objects\TimePeriodObject;
use App\Product;
use Illuminate\Support\Facades\DB;

class DbProductsRepository extends AbstractEloquentRepository implements ProductsRepository
{
    /**
     * @param $id
     * @return Product
     */
    public function getProductById($id) : Product
    {
        return Product::query()->where('id', $id)->first();
    }

    /**
     * @return Product[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllProducts()
    {
        return Product::all();
    }

    /**
     * @return Product[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllProductsArray()
    {
        return $this->getAllProducts()->toArray();
    }

    /**
     * @param EntityFilterRequest $entityFilterRequest
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getFilteredItems(EntityFilterRequest $entityFilterRequest)
    {
        return parent::getFilteredItems($entityFilterRequest
            ->setBaseFilterQueryBuilder(Product::query()->with(['color', 'size', 'category']))
            ->setEntityRelationsFilters(Product::$relationsFilters)
        );
    }

    /**
     * @param int $count
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getLastProducts($count = 10)
    {
        return $this->getFullProductQuery()
            ->orderByDesc('id')
            ->paginate($count);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function getProductWithOrders($id) //TODO нужен ли???
    {
        return Product::query()->with('orders')->find($id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function getProductsWithSalesStats()
    {
        return $this->getProductsWithSalesStatsQuery()->get();
    }

    /**
     * @param $column
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function getProductsWithSalesStatsOrderByDesc($column)
    {
        return $this->getProductsWithSalesStatsQuery()
            ->orderByDesc($column)
            ->get();
    }

    /**
     * @param TimePeriodObject $timePeriodObject
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function getProductsWithSalesStatsByPeriod(TimePeriodObject $timePeriodObject)
    {
        return $this->getProductsWithSalesStatsQuery()
            ->where('order_products.created_at', '>', $timePeriodObject->getFromDate())
            ->where('order_products.created_at', '<', $timePeriodObject->getTillDate())
            ->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public function getProductsWithSalesStatsQuery()
    {
        return Product::query()
            ->select('products.id', 'products.name', 'products.base_price')
            ->addSelect(DB::raw('SUM(order_products.quantity) as quantity'))
            ->addSelect(DB::raw('SUM(order_products.sum) as profit'))
            ->leftJoin('order_products', function($sql){
                $sql->on('products.id', '=', 'order_products.product_id');
            })
            ->groupBy(['products.id', 'products.name', 'products.base_price']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getFullProductQuery()
    {
        return Product::query()->with(['color', 'size', 'category']);
    }

    /**
     * @param ChangeProductQuantityRequest $request
     */
    public function updateProductQuantity(ChangeProductQuantityRequest $request)
    {
        Product::query()
            ->where("id", $request->getProductId())
            ->update(['quantity' => $request->getProductQuantity()]);
    }
}