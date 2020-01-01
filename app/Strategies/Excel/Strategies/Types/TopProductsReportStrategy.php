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
use App\Objects\TimePeriodObject;
use App\Order;
use App\Product;
use App\Repositories\ProductsRepository;
use App\Strategies\Interfaces\ExcelReportStrategyInterface;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class TopProductsReportStrategy extends AbstractReportTypeStrategy implements ExcelReportStrategyInterface
{
    /**
     * @var ProductsRepository
     */
    private $productsRepository;

    /**
     * TopProductsReportStrategy constructor.
     * @param ProductsRepository $productsRepository
     */
    public function __construct(ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    /**
     * @param DocumentBuilderInterface $builder
     * @param CreateReportRequestObject $requestObject
     * @return mixed
     */
    public function setReportData(DocumentBuilderInterface $builder, CreateReportRequestObject $requestObject)
    {
        $this->initialize($builder, $requestObject);

        $products = $this->productsRepository
            ->getProductsWithSalesStatsByPeriod((new TimePeriodObject())
                ->setFromDate($requestObject->getFromDate())
                ->setTillDate($requestObject->getTillDate())
            )
            ->sortByDesc('quantity')
            ->map(function($product) {
                return [
                    'Id товара'     => $product->id,
                    'Название'      => $product->name,
                    'Продано'       => $product->quantity,
                    'Цена'          => $product->real_price,
                    'Общая прибыль' => $product->profit,
                ];
            });

        //TODO выглядит хреново
        if ($products->isNotEmpty()) {
            $builder->addRow(array_keys($products->first()), 1);
        }

        foreach ($products->values() as $key => $product) {
            $builder->addRow($product, $key + 2);
        }
        /////////////////////////
    }

    /**
     * @return string
     */
    public function getReportName()
    {
        return 'top_products_report' . Carbon::now()->format('Y_m_d');
    }
}
