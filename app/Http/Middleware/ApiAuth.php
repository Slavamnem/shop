<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @param Request $request
     */
    public function __construct(Request $request)
    {
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
     * @param array $guards
     * @throws AuthenticationException
     */
    protected function authenticate(array $guards)
    {
        if ($token = $this->request->header("Api-Token")) {
            if ($user = User::query()->where("api_token", $token)->first()) {
                Auth::login($user);
            } else {
                throw new AuthenticationException('Unauthenticated.', $guards);
            }
        } else {
            throw new AuthenticationException('Unauthenticated.', $guards);
        }
    }
}
