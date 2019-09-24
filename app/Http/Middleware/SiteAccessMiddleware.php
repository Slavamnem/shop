<?php

namespace App\Http\Middleware;

use App\AdminAuth;
use App\Components\SecurityCenter;
use Closure;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SiteAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!App::make(SecurityCenter::class)->checkUserIp()) exit();

        Log::info('request: ' . json_encode($request->all(), JSON_UNESCAPED_UNICODE));

        if (App::make(SecurityCenter::class)->requestHasThreat()) exit();

        $response = $next($request);

        return $response;
    }
}
