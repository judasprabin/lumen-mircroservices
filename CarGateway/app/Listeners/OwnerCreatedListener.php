<?php

namespace App\Listeners;

use App\Events\OwnerCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OwnerCreatedListener
{

    /**
     * Handle the event.
     *
     * @param  \App\Events\OwnerCreatedEvent  $event
     * @return void
     */
    public function handle(OwnerCreatedEvent $event)
    {
        /**
         * We define the operations to that events here
         */
        var_dump('Some Action');
    }
}
