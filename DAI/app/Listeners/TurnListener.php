<?php

namespace App\Listeners;

use App\Events\playerTurn;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TurnListener
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
     * @param  playerTurn  $event
     * @return void
     */
    public function handle(playerTurn $event)
    {
        //
    }
}
