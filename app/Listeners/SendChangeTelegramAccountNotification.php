<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ChangeTelegramAccount;

class SendChangeTelegramAccountNotification
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
     * @param  object  $event
     * @return void
     */
    public function handle(ChangeTelegramAccount $event)
    {
        $event->user->sendChangeTelegramAccountNotification($event->code);
    }
}
