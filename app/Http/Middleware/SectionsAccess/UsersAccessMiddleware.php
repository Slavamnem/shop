<?php

namespace App\Http\Middleware\SectionsAccess;

use App\AdminAuth;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use InstagramAPI\Exception\BadRequestException;

class UsersAccessMiddleware
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
        if (Auth::user()->can('watchUsers', User::class)) {
            return $next($request);
        } else {
            //return $next($request);
            throw new BadRequestException();
        }
    }
}
