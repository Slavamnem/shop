<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 31.12.2019
 * Time: 0:22
 */

namespace App\Providers\Custom;

use App\Repositories\DbProductsRepository;
use App\Repositories\ProductsRepository;
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

class RepositoriesProvider extends ServiceProvider
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
        $this->app->bind(ProductsRepository::class, DbProductsRepository::class);
    }
}