<?php

namespace App\Console\Commands;

use App\Product;
use App\Repositories\ProductsRepository;
use App\Services\ElasticSearchService;
use Illuminate\Console\Command;

class IndexProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'index-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @var ElasticSearchService
     */
    private $elasticService;

    /**
     * @var ProductsRepository
     */
    private $productsRepository;

    /**
     * IndexProducts constructor.
     * @param ElasticSearchService $elasticService
     * @param ProductsRepository $productsRepository
     */
    public function __construct(ElasticSearchService $elasticService, ProductsRepository $productsRepository)
    {
        parent::__construct();
        $this->elasticService = $elasticService;
        $this->productsRepository = $productsRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach ($this->productsRepository->getAllProducts() as $product) {
            $this->elasticService->indexProduct($product);
        }
    }
}
