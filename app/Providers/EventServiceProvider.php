<?php

namespace App\Providers;

use App\Events\Attack;
use App\Events\NewOrderEvent;
use App\Listeners\AttackListener;
use App\Listeners\MailSendListener;
use App\Listeners\NewOrderListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
        "Illuminate\Mail\Events\MessageSending" => [
            MailSendListener::class
        ],
        NewOrderEvent::class => [
            NewOrderListener::class
        ],
        Attack::class => [
            AttackListener::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
