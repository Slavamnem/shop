<?php

namespace App\Providers;

use App\Components\RestApi\NovaPoshta;
use App\Notification;
use App\Services\Admin\BasketService;
use App\Services\Admin\ClientService;
use App\Services\Admin\Interfaces\ClientServiceInterface;
use App\Services\Admin\Interfaces\ShareServiceInterface;
use App\Services\Admin\Interfaces\StatisticServiceInterface;
use App\Services\Admin\OrderPriceCalcService;
use App\Services\Admin\OrderService;
use App\Services\Admin\ProductService;
use App\Services\Admin\ShareService;
use App\Services\Admin\StatisticService;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Services\Admin\Interfaces\ProductServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    public static $total = 0;
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

        View::share("notifications", Notification::query()
//            ->where("status", 'active')
            ->orderByDesc('created_at')
            ->take(10)
            ->get());


        DB::listen(function($query){
           //dump($query->sql);
            self::$total++;
            //dump(self::$total);
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
        $this->app->bind(ClientServiceInterface::class, ClientService::class);
        $this->app->bind(StatisticServiceInterface::class, StatisticService::class);

        $this->app->bind(OrderService::class);
        $this->app->bind(NovaPoshta::class);
        $this->app->bind(BasketService::class);
        $this->app->bind(OrderPriceCalcService::class);
    }
}
