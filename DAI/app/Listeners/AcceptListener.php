<?php

namespace App\Listeners;

use App\Events\newAcceptRequest;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AcceptListener
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
     * @param  newAcceptRequest  $event
     * @return void
     */
    public function handle(newAcceptRequest $event)
    {
        //
    }
}
