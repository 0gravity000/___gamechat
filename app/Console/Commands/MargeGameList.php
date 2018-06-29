<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\SortGameList;    //イベントクラス名とかぶるとダメ

class MargeGameList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'marge:gamelist';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Marge Game List';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        event(new SortGameList());
    }
}
