<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apikey;
use App\Game;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class GamesController extends Controller
{
    public function index() {
  		$games = Game::all();
  		return view('home', compact('games'));
    }

    public function initialize() {
      $storagePath = ('/public/games/');
      $storagePathName = $storagePath. 'games.txt';
      $contents = Storage::get($storagePathName);

      $gamelists = [];
      $startpos = 0;
      while (mb_strpos($contents, ',', $startpos)) {
        $endpos = mb_strpos($contents, ',', $startpos);
        $title = mb_substr($contents, $startpos, $endpos - $startpos);
        $title = str_replace(array("\r\n", "\r", "\n"), '', $title);	//改行コード削除
        $params = array(
          "title" => $title,
        );
        //var_dump($params);
        array_push($gamelists, $params);
        //$br = mb_strpos($contents, '\n', $startpos);
        $startpos = $endpos +1;
      }

  		$games = Game::all();
  		if ($games->isEmpty()) {
  			for ($i=0; $i < count($gamelists); $i++) { 
  				$game = new Game;
  				$game->title = array_get($gamelists[$i], 'title');
  				$game->priority = 500;
  				$game->save();
  			}
  		} else {
	  			for ($i=0; $i < count($gamelists); $i++) {
	  				$games = Game::where('title', array_get($gamelists[$i], 'title'));
	  				if (!$games) {
		  				$game = new Game;
		  				$game->title = array_get($gamelists[$i], 'title');
		  				$game->priority = 500;
		  				$game->save();
	  				}
	  			}
  		}

  		$games = Game::all();
  		//dd($games);
  		return view('layouts.sidebar_left', compact('games'));
    }

}
