<?php

namespace App\Providers;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;
use App\Events\OwnerCreatedEvent;
use App\Listeners\OwnerCreatedListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener on owner created.
     *
     * @var array
     */
    protected $listen = [
        OwnerCreatedEvent::class => [
            OwnerCreatedListener::class,
        /** add more listerners*/
            //subscribe newsletter
            //send tutorial
        ],
    ];

    /**
     * Register any evnts for applications
     * 
     * @return void
     */

    public function boot()
    {
        parent::boot();
    }
}
