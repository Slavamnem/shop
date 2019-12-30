<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 31.12.2019
 * Time: 0:22
 */

namespace App\Providers\Custom;

use App\Components\EmailDrivers\MailGunDriver;
use App\Components\Interfaces\DropBoxClientInterface;
use App\Components\Interfaces\EmailDriverInterface;
use App\Components\Interfaces\NovaPoshtaInterface;
use App\Components\RestApi\DropBox;
use App\Components\RestApi\NovaPoshta;
use Illuminate\Support\ServiceProvider;

class ApiDriversProvider extends ServiceProvider
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
        $this->app->bind(DropBoxClientInterface::class, DropBox::class);
        $this->app->bind(EmailDriverInterface::class, MailGunDriver::class);
        $this->app->bind(NovaPoshtaInterface::class, NovaPoshta::class);
        $this->app->bind(NovaPoshta::class);

    }
}