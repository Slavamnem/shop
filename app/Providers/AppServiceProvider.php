<?php

namespace App\Providers;

use App\Adapters\Interfaces\ShareConditionsAdapterInterface;
use App\Adapters\ShareConditionsAdapter;
use App\Builders\ConditionsBuilder;
use App\Builders\Interfaces\ConditionsBuilderInterface;
use App\Builders\Interfaces\ShareProductsQueryBuilderInterface;
use App\Builders\ShareProductsQueryBuilder;
use App\Components\AppCenter;
use App\Components\EmailDrivers\MailGunDriver;
use App\Components\Helpers\SqlHelper;
use App\Components\Interfaces\AppCenterInterface;
use App\Components\Interfaces\DropBoxClientInterface;
use App\Components\Interfaces\EmailDriverInterface;
use App\Components\Interfaces\NovaPoshtaInterface;
use App\Components\Interfaces\SecurityCenterInterface;
use App\Components\RestApi\DropBox;
use App\Components\RestApi\MailGunClient;
use App\Components\RestApi\NovaPoshta;
use App\Components\SecurityCenter;
use App\Components\ShareConditions\Interfaces\ShareConditionBuilderInterface;
use App\Components\ShareConditions\ShareConditionBuilders\ShareConditionBuilder;
use App\Components\Signals\DeleteRecordSignal;
use App\Events\Attack;
use App\Events\MessageToTelegram;
use App\Notification;
use App\Services\RestApi\Interfaces\ImageStorageServiceInterface;
use App\Services\Admin\BasketService;
use App\Services\Admin\ClientService;
use App\Services\Admin\ConditionsService;
use App\Services\Admin\ExcelService;
use App\Services\Admin\Interfaces\BasketServiceInterface;
use App\Services\Admin\Interfaces\ClientServiceInterface;
use App\Services\Admin\Interfaces\ExcelServiceInterface;
use App\Services\Admin\Interfaces\NewYorkTimesServiceInterface;
use App\Services\Admin\Interfaces\NovaPoshtaServiceInterface;
use App\Services\Admin\Interfaces\ShareServiceInterface;
use App\Services\Admin\Interfaces\SiteElementsServiceInterface;
use App\Services\Admin\Interfaces\StatisticServiceInterface;
use App\Services\Admin\Interfaces\UserServiceInterface;
use App\Services\Admin\NewYorkTimesService;
use App\Services\Admin\OrderPriceCalcService;
use App\Services\Admin\OrderService;
use App\Services\Admin\ProductService;
use App\Services\Admin\ShareService;
use App\Services\Admin\SiteElementsService;
use App\Services\Admin\StatisticService;
use App\Services\Admin\UserService;
use App\Services\ElasticSearchService;
use App\Services\NovaPoshtaService;
use App\Services\RestApi\DropBoxService;
use App\Services\Site\Api\CatalogProductsService;
use App\Services\Site\Interfaces\CatalogProductsServiceInterface;
use App\Services\Site\Interfaces\ElasticSearchServiceInterface;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
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
//            dump($query->sql);

            if (strpos($query->sql, 'delete ') !== false) {
                Event::fire(new MessageToTelegram(
                    "Пользователь " . @Auth::user()->login . "(" . Auth::id() . ")" . " удалил запись. \nЗапрос: " . SqlHelper::restoreSql($query)
                ));

                App::make(AppCenter::class)->sendSignal(new DeleteRecordSignal());
            }

            //self::$total++;
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
        $this->app->bind(ConditionsBuilderInterface::class, ConditionsBuilder::class); //TODO deprecated
        $this->app->bind(ShareConditionBuilderInterface::class, ShareConditionBuilder::class);
        $this->app->bind(ShareProductsQueryBuilderInterface::class, ShareProductsQueryBuilder::class);

        $this->app->bind(NovaPoshtaServiceInterface::class, NovaPoshtaService::class);
        $this->app->bind(DropBoxClientInterface::class, DropBox::class);
        $this->app->bind(ImageStorageServiceInterface::class, DropBoxService::class);
        $this->app->bind(EmailDriverInterface::class, MailGunDriver::class);
        $this->app->bind(NovaPoshtaInterface::class, NovaPoshta::class);
        $this->app->bind(NovaPoshta::class);

        $this->app->bind(OrderService::class);
        $this->app->bind(OrderPriceCalcService::class);

        $this->app->singleton(AppCenter::class);
        $this->app->singleton(SecurityCenter::class, SecurityCenter::class);
        $this->app->singleton(AppCenterInterface::class, AppCenter::class);
        $this->app->singleton(SecurityCenterInterface::class, SecurityCenter::class);

        $this->app->singleton(ElasticSearchServiceInterface::class, ElasticSearchService::class);
        $this->app->singleton(NewYorkTimesServiceInterface::class, NewYorkTimesService::class);
        $this->app->singleton(ExcelServiceInterface::class, ExcelService::class);

        $this->app->singleton(ShareConditionsAdapterInterface::class, ShareConditionsAdapter::class);

        $this->app->bind('conditions', ConditionsService::class);
    }
}
