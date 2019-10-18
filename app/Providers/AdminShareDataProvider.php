<?php

namespace App\Providers;

use App\Components\RestApi\Exchange;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AdminShareDataProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share("usd_rate", (new Exchange())->getRate());
        View::share("eur_rate", (new Exchange())->getRate('EUR', "UAH"));
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
