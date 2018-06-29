<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\FetchGameList;    //イベントクラス名とかぶるとダメ

class GetGamaList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:gamelist {page}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Game List using amazon api. get:gamelist {page}';

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
        event(new FetchGameList($this->argument('page')));
    }
}
