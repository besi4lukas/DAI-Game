<?php

namespace App\Listeners;

use App\Events\newDeclineRequest;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeclineListener
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
     * @param  newDeclineRequest  $event
     * @return void
     */
    public function handle(newDeclineRequest $event)
    {
        //
    }
}
