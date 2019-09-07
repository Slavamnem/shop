<?php

namespace App\Providers;

use App\Builders\ConditionsBuilder;
use App\Builders\Interfaces\ConditionsBuilderInterface;
use App\Builders\Interfaces\ShareProductsQueryBuilderInterface;
use App\Builders\ShareProductsQueryBuilder;
use App\Components\Interfaces\NovaPoshtaInterface;
use App\Components\RestApi\NovaPoshta;
use App\Notification;
use App\Services\Admin\BasketService;
use App\Services\Admin\ClientService;
use App\Services\Admin\ConditionsService;
use App\Services\Admin\Interfaces\BasketServiceInterface;
use App\Services\Admin\Interfaces\ClientServiceInterface;
use App\Services\Admin\Interfaces\NovaPoshtaServiceInterface;
use App\Services\Admin\Interfaces\ShareServiceInterface;
use App\Services\Admin\Interfaces\SiteElementsServiceInterface;
use App\Services\Admin\Interfaces\StatisticServiceInterface;
use App\Services\Admin\Interfaces\UserServiceInterface;
use App\Services\Admin\OrderPriceCalcService;
use App\Services\Admin\OrderService;
use App\Services\Admin\ProductService;
use App\Services\Admin\ShareService;
use App\Services\Admin\SiteElementsService;
use App\Services\Admin\StatisticService;
use App\Services\Admin\UserService;
use App\Services\NovaPoshtaService;
use App\Services\Site\Api\CatalogProductsService;
use App\Services\Site\Interfaces\CatalogProductsServiceInterface;
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
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(BasketServiceInterface::class, BasketService::class);
        $this->app->bind(SiteElementsServiceInterface::class, SiteElementsService::class);
        $this->app->bind(CatalogProductsServiceInterface::class, CatalogProductsService::class);
        $this->app->bind(ConditionsBuilderInterface::class, ConditionsBuilder::class);
        $this->app->bind(ShareProductsQueryBuilderInterface::class, ShareProductsQueryBuilder::class);

        $this->app->bind(NovaPoshtaServiceInterface::class, NovaPoshtaService::class);
        $this->app->bind(NovaPoshtaInterface::class, NovaPoshta::class);
        $this->app->bind(NovaPoshta::class);

        $this->app->bind(OrderService::class);
        $this->app->bind(OrderPriceCalcService::class);

        $this->app->bind('conditions', ConditionsService::class);
    }
}
