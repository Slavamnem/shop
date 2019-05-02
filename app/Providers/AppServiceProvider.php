<?php

namespace App\Providers;

use App\Components\RestApi\NovaPoshta;
use App\Services\Admin\BasketService;
use App\Services\Admin\Interfaces\ShareServiceInterface;
use App\Services\Admin\OrderService;
use App\Services\Admin\ProductService;
use App\Services\Admin\ShareService;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;
use App\Services\Admin\Interfaces\ProductServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Queue::before(function (JobProcessing $event) {
            // $event->connectionName
            // $event->job
            // $event->job->payload()
            Log::info("before");
        });

        Queue::failing(function (JobFailed $event) {
            // $event->connectionName
            // $event->job
            // $event->job->payload()
            Log::info("fail");
        });

        Queue::after(function (JobProcessed $event) {
            // $event->connectionName
            // $event->job
            // $event->job->payload()
            Log::info("after");
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(ShareServiceInterface::class, ShareService::class);

        $this->app->bind('OrderService', function ($app) {
            return new OrderService();
        });

        $this->app->bind(NovaPoshta::class);
        $this->app->bind(BasketService::class);
    }
}
