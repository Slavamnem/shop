<?php

namespace App\Providers;

use App\Services\Admin\OrderService;
use App\Services\Admin\ProductService;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;

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

        $this->app->bind('ProductService', function ($app) {
            return new ProductService();
        });

        $this->app->bind('OrderService', function ($app) {
            return new OrderService();
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
