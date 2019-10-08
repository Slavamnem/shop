<?php

namespace App\Console\Commands;

use App\Product;
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
     * IndexProducts constructor.
     * @param ElasticSearchService $elasticService
     */
    public function __construct(ElasticSearchService $elasticService)
    {
        parent::__construct();
        $this->elasticService = $elasticService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach (Product::all() as $product) {
            $this->elasticService->indexProduct($product);
        }
    }
}
