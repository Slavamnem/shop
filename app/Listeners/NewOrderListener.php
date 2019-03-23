<?php

namespace App\Listeners;

use App\Events\NewOrderEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewOrderListener
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
     * Handle the event.
     *
     * @param  NewOrderEvent $event
     * @return void
     */
    public function handle(NewOrderEvent $event)
    {
        dump($event->getName());
        dump("new order!!!");
    }
}
