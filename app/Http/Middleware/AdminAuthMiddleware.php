<?php

namespace App\Http\Middleware;

use App\AdminAuth;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuthMiddleware
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
        //dump("auth middleware");
        $response = $next($request);

        AdminAuth::create([
            'user_id'    => Auth::id(),
            'trace'      => debug_backtrace(),
            'ip_address' => $_SERVER['REMOTE_ADDR']
        ]);

        return $response;
    }
}
