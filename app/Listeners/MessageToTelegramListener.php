<?php

namespace App\Listeners;

use App\AdminAuth;
use App\Events\Attack;
use App\Events\MessageToTelegram;
use App\Notifications\AttackNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessageToTelegramListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param MessageToTelegram $event
     */
    public function handle(MessageToTelegram $event)
    {
        (new AdminAuth())->notify(new AttackNotification($event->message));
    }
}
