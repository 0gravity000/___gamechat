<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AmazonGameMargeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      $dt = Carbon::now();
      $folder = $dt->year.'-'.sprintf('%02d', $dt->month).'-'.sprintf('%02d', $dt->day).'/';
      $storagePath = ('/public/games/');
  
      $games = [];
      for ($page=1; $page < 11; $page++) { 
        $file = 'outputpage_'.$page.'.txt';
        //$storagePath = storage_path('app/public/games/'. $outputfile);
        $storagePathName = $storagePath. $folder. $file;

        $contents = Storage::get($storagePathName);

        $startpos = 0;
        while (mb_strpos($contents, ',', $startpos)) {
          $endpos = mb_strpos($contents, ',', $startpos);
          $title = mb_substr($contents, $startpos, $endpos - $startpos);
          var_dump($title);

          $params = array(
            "title" => $title,
          );
          //var_dump($params);
          array_push($games, $params);
          //$br = mb_strpos($contents, '\n', $startpos);
          $startpos = $endpos +1;
        }
      }

      $games = array_values(array_sort($games, function ($value) {
        return $value['title'];
      }));

      $outputfile = 'games_top100.txt';
      $storagePath = ('/public/games/');
      $storagePathName = $storagePath. $folder. $outputfile;

      $fileOutputString = "";
      for ($i=0; $i < count($games); $i++) { 
        $fileOutputString = $fileOutputString . array_get($games[$i],'title').'\\n';
      }
      Storage::put($storagePathName, $fileOutputString );
      var_dump('file output done!');
    }
}
