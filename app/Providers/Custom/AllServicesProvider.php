<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 31.12.2019
 * Time: 0:22
 */

namespace App\Providers\Custom;

use App\Services\Admin\BasketService;
use App\Services\Admin\ClientService;
use App\Services\Admin\ExcelService;
use App\Services\Admin\Graphics\GraphicsService;
use App\Services\Admin\Interfaces\BasketServiceInterface;
use App\Services\Admin\Interfaces\ClientServiceInterface;
use App\Services\Admin\Interfaces\ExcelServiceInterface;
use App\Services\Admin\Interfaces\GraphicsServiceInterface;
use App\Services\Admin\Interfaces\NewYorkTimesServiceInterface;
use App\Services\Admin\Interfaces\NovaPoshtaServiceInterface;
use App\Services\Admin\Interfaces\ProductServiceInterface;
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
use App\Services\RestApi\Interfaces\ImageStorageServiceInterface;
use App\Services\Site\Api\CatalogProductsService;
use App\Services\Site\Interfaces\CatalogProductsServiceInterface;
use App\Services\Site\Interfaces\ElasticSearchServiceInterface;
use Illuminate\Support\ServiceProvider;

class AllServicesProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

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
        $this->app->bind(GraphicsServiceInterface::class, GraphicsService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(BasketServiceInterface::class, BasketService::class);
        $this->app->bind(SiteElementsServiceInterface::class, SiteElementsService::class);
        $this->app->bind(CatalogProductsServiceInterface::class, CatalogProductsService::class);
        $this->app->bind(NovaPoshtaServiceInterface::class, NovaPoshtaService::class);
        $this->app->bind(ImageStorageServiceInterface::class, DropBoxService::class);
        $this->app->bind(OrderPriceCalcService::class);
        $this->app->singleton(ElasticSearchServiceInterface::class, ElasticSearchService::class);
        $this->app->singleton(NewYorkTimesServiceInterface::class, NewYorkTimesService::class);
        $this->app->singleton(ExcelServiceInterface::class, ExcelService::class);
        $this->app->bind(OrderService::class);
    }
}