<?php

namespace App\Listeners;

use App\Events\FetchGameList;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Jobs\AmazonGameJob;
//use Illuminate\Foundation\Bus\DispatchesJobs;   //???need use dispatch()

class OutputGameList
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
     * @param  FetchGameList  $event
     * @return void
     */
    public function handle(FetchGameList $event)
    {
        $page = $event->page;
        dispatch(new AmazonGameJob($page));
    }
}
