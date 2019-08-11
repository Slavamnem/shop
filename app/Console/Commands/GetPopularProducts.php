<?php

namespace App\Console\Commands;

use App\Console\Commands\CommandType\CommandType;
use App\Console\Commands\Responses\TextResponse;
use App\Product;
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
    protected $signature = 'command:get-popular-products {--type=table} {--view=page}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * GetPopularProducts constructor.
     */
    public function __construct()
    {
        parent::__construct();
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
        Session::put('commandResponse', $this->response->render());
        Session::put('commandViewType', $this->option('view'));
        //return $this->response->getData();
    }

    /**
     * @return array
     */
    private function getProducts()
    {
        $service = resolve(StatisticServiceInterface::class);
        $products = Product::query()->with('orders')->get();
        $service->getProductsSales($products);
        $products = $products->sortByDesc('quantity');

        $products = $products->map(function($product){
            return $product->only(['name', 'base_price', 'quantity', 'active', 'profit']);
        });

        return array_slice($products->toArray(), 0, 5);
    }
}
