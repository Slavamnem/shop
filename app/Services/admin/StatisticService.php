<?php

namespace App\Services\Admin;

use App\Product;
use App\Services\Admin\Interfaces\StatisticServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Class StatisticService
 * @package App\Services\Admin
 */
class StatisticService implements StatisticServiceInterface
{
    /**
     * @var Request
     */
    private $request;

    /**
     * StatisticService constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getProductsList()
    {
        $products = Product::query()->with('orders')->get();

        $this->getProductsSales($products);

        $sortField = ($this->request->input('checked') == "true") ? 'profit' : 'quantity';

        return $products->sortByDesc($sortField);
    }

    /**
     * @param Collection $products
     * @return Collection
     */
    private function getProductsSales(Collection $products)
    {
        foreach ($products as $product) {
            $product->quantity = $product->orders->sum("quantity");
            $product->profit = $product->orders->sum("sum");
        }

        return $products;
    }
}
