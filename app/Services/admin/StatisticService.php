<?php

namespace App\Services\Admin;

use App\Product;
use App\Repositories\ProductsRepository;
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
     * @var ProductsRepository
     */
    private $productsRepository;

    /**
     * StatisticService constructor.
     * @param Request $request
     * @param ProductsRepository $productsRepository
     */
    public function __construct(Request $request, ProductsRepository $productsRepository)
    {
        $this->request = $request;
        $this->productsRepository = $productsRepository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getProductsList()
    {
        return $this->productsRepository->getProductsWithSalesStatsOrderByDesc($this->getProductsSortColumn());
    }

    /**
     * @return string
     */
    private function getProductsSortColumn()
    {
        return ($this->request->input('checked') == "true") ? 'profit' : 'quantity'; //Создать кастомный реквест с этим методом TODO shit
    }
}
