<?php

namespace App\Listeners;

use Config;
use App\Events\UserRegistered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\NewUserRegisteredMessageToUser;
use App\Mail\NewUserRegisteredMessageToClient;

class sendEmailNewUserRegistered
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
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
      Mail::to(config('data_app.destinatario_tienda'))->queue(new NewUserRegisteredMessageToClient($event->user));
      Mail::to($event->user->email)->queue(new NewUserRegisteredMessageToUser($event->user));
    }
}
