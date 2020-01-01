<?php

namespace App\Console\Commands;

use App\Console\Commands\CommandType\CommandType;
use App\Console\Commands\Decorators\BaseDecorator;
use App\Console\Commands\Responses\TextResponse;
use App\Product;
use App\Repositories\ProductsRepository;
use App\Services\Admin\Interfaces\StatisticServiceInterface;
use App\Services\Admin\StatisticService;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetPopularProducts extends AbstractCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:get-popular-products {--type=table} {--view=page} {--decor=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @var ProductsRepository
     */
    private $productRepository;

    /**
     * GetPopularProducts constructor.
     * @param ProductsRepository $productsRepository
     */
    public function __construct(ProductsRepository $productsRepository)
    {
        parent::__construct();
        $this->productRepository = $productsRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        parent::handle();

        $this->response->setData($this->getProducts());
        $this->response->render();

        if ($decorType = $this->option('decor')) {
            $this->response = BaseDecorator::getDecorator($decorType, $this->response);
            $this->response->decorate();
        }

        Session::put('commandResponse', $this->response->getData());
        Session::put('commandViewType', $this->option('view'));
        //return $this->response->getData();
    }

    /**
     * @return array
     */
    private function getProducts()
    {
        return array_slice($this->productRepository
            ->getProductsWithSalesStatsOrderByDesc('quantity')
            ->map(function($product){
                return $product->only(['name', 'base_price', 'quantity', 'active', 'profit']);
            })
            ->toArray(),
            0,
            5
        );
    }
}
