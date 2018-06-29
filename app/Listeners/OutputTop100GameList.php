<?php

namespace App\Listeners;

use App\Events\SortGameList;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Jobs\AmazonGameMargeJob;

class OutputTop100GameList
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
     * @param  SortGameList  $event
     * @return void
     */
    public function handle(SortGameList $event)
    {
        dispatch(new AmazonGameMargeJob());
    }
}
