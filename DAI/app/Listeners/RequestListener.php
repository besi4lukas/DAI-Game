<?php

namespace App\Listeners;

use App\Events\newRequest;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RequestListener
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
     * @param  newRequest  $event
     * @return void
     */
    public function handle(newRequest $event)
    {
        //
    }
}
