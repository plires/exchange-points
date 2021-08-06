<?php

namespace App\Listeners;

use App\Events\UserConfirmed;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\NewUserConfirmedMessageToUser;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendEmailUserConfirmed
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
     * @param  UserConfirmed  $event
     * @return void
     */
    public function handle(UserConfirmed $event)
    {
        Mail::to($event->user->email)->queue(new NewUserConfirmedMessageToUser($event->user));
    }
}
