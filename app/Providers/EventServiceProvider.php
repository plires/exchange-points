<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        \App\Events\ProductSaved::class => [
            \App\Listeners\optimizeProductImage::class,
        ],
        \App\Events\UserRegistered::class => [
            \App\Listeners\sendEmailNewUserRegistered::class,
        ],
        \App\Events\UserConfirmed::class => [
            \App\Listeners\sendEmailUserConfirmed::class,
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
