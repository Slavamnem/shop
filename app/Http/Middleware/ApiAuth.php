<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;

class ApiAuth
{
    /**
     * The authentication factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;
    /**
     * @var Request
     */
    private $request;

    /**
     * ApiAuth constructor.
     * @param Auth $auth
     * @param Request $request
     */
    public function __construct(Auth $auth, Request $request)
    {
        $this->auth = $auth;
        $this->request = $request;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($guards);

        return $next($request);
    }

    /**
     * Determine if the user is logged in to any of the given guards.
     *
     * @param  array  $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function authenticate(array $guards)
    {
        $token = $this->request->header("Api-Token");
        $user = User::query()->where("api_token", $token)->first();

        if ($token and $user) {
            \Illuminate\Support\Facades\Auth::loginUsingId($user->id);
        } else {
            throw new AuthenticationException('Unauthenticated.', $guards);
        }

    }
}
