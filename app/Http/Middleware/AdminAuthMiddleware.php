<?php

namespace App\Http\Middleware;

use App\AdminAuth;
use App\Components\SecurityCenter;
use App\Enums\EmailTemplatesEnum;
use App\Events\TriggerEvent;
use Closure;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Lang;

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
        if (env('ADMIN_PANEL_ACCESS') == 0) {
            exit();
        } elseif (!App::make(SecurityCenter::class)->checkUserIp() or App::make(SecurityCenter::class)->requestHasThreat()) {
            echo(Lang::get('access_messages.blocked_user_message'));
            exit();
        }

        $response = $next($request);

        AdminAuth::create([
            'user_id'    => Auth::id(),
            'trace'      => debug_backtrace(),
            'ip_address' => $_SERVER['REMOTE_ADDR']
        ]);

//        Event::fire((new TriggerEvent())
//            ->setDataForTemplate(['id' => 777])
//            ->setEmailTemplateId(EmailTemplatesEnum::ORDER_CREATED)
//        );

        return $response;
    }
}
