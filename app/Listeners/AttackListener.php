<?php

namespace App\Listeners;

use App\AdminAuth;
use App\Events\Attack;
use App\Notifications\AttackNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AttackListener
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
     * @param Attack $event
     */
    public function handle(Attack $event)
    {
        (new AdminAuth())->notify(new AttackNotification());
    }
}
