<?php

namespace App\Console\Commands;

use App\Console\Commands\CommandType\CommandType;
use App\Console\Commands\Responses\TextResponse;
use App\Product;
use App\Services\Admin\Interfaces\StatisticServiceInterface;
use App\Services\Admin\StatisticService;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetPopularProducts extends AbstractCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:get-popular-products {--type=text}';

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

    public function init()
    {
        $this->commandType = CommandType::create($this->option('type'));
        $this->response = $this->commandType->getCommandResponse();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->init();

        $service = resolve(StatisticServiceInterface::class);
        $products = Product::query()->with('orders')->get();
        $service->getProductsSales($products);
        $products = $products->sortByDesc('quantity');

        $this->response->setData(array_slice($products->toArray(), 0, 5));
        //dump(array_slice($products->toArray(), 0, 5));

        dump($this->commandType);
        dump($this->response);
    }
}
