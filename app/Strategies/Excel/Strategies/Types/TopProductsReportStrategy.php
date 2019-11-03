<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.10.2019
 * Time: 0:14
 */

namespace App\Strategies\Excel\Strategies\Types;

use App\Builders\Interfaces\DocumentBuilderInterface;
use App\Objects\CreateReportRequestObject;
use App\Order;
use App\Product;
use App\Strategies\Interfaces\ExcelReportStrategyInterface;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class TopProductsReportStrategy extends AbstractReportTypeStrategy implements ExcelReportStrategyInterface
{
    /**
     * @param DocumentBuilderInterface $builder
     * @param CreateReportRequestObject $requestObject
     * @return mixed
     */
    public function setReportData(DocumentBuilderInterface $builder, CreateReportRequestObject $requestObject)
    {
        $this->initialize($builder, $requestObject);

        $products = Product::query()->with(['orders' => function($query){
            return $query->where('created_at', '>=', $this->requestObject->getFromDate())
                ->where('created_at', '<=', $this->requestObject->getTillDate());
        }])->get();
        $products = $this->getProductsSales($products);
        $products = $products->sortByDesc('sold');
        $products = $products->map(function($product) {
            return [
                'Id товара'     => $product->id,
                'Название'      => $product->name,
                'Продано'       => $product->sold,
                'Цена'          => $product->real_price,
                'Общая прибыль' => $product->profit,
            ];
        });

        if ($products->isNotEmpty()) {
            $builder->addRow(array_keys($products->first()), 1);
        }

        foreach ($products->values() as $key => $product) {
            $builder->addRow($product, $key + 2);
        }
    }

    /**
     * @return string
     */
    public function getReportName()
    {
        return 'top_products_report' . Carbon::now()->format('Y_m_d');
    }

    /**
     * @param Collection $products
     * @return Collection
     */
    private function getProductsSales(Collection $products)
    {
        foreach ($products as $product) {
            $product->sold = $product->orders->sum("quantity");
            $product->profit = $product->orders->sum("sum");
        }

        return $products;
    }
}
