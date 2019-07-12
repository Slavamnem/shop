<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\DefaultNotification;
use App\Order;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * @var Request
     */
    private $request;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * LoginController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return "login";
    }

    public function __destruct()
    {
        if (Auth::check()) {
            Auth::user()->notify(new DefaultNotification());
        } else {
            (new User(
                ['login' => $this->request->input('login'), 'password' => $this->request->input('password')]
            ))->notify(new DefaultNotification());
        }

    }
}
