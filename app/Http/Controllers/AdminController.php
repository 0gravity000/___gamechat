<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Game;
use App\Apikey;

class AdminController extends Controller
{
    public function initialize() {
    	//amazonで人気のゲームの設定
      $storagePath = ('/public/games/');
      $storagePathName = $storagePath. 'games.txt';
      $contents = Storage::get($storagePathName);

      //$gamelists = [];
      $startpos = 0;
      while (mb_strpos($contents, ',', $startpos)) {
        $endpos = mb_strpos($contents, ',', $startpos);
        $title = mb_substr($contents, $startpos, $endpos - $startpos);
        $title = str_replace(array("\r\n", "\r", "\n"), '', $title);	//改行コード削除
        //$params = array(
        //  "title" => $title,
        //);
        //var_dump($params);
        //array_push($gamelists, $params);
        //$br = mb_strpos($contents, '\n', $startpos);
        $startpos = $endpos +1;

        //gamesに登録
				$games = Game::where('title', $title)->first();
				if (!$games) {
					$game = new Game;
					$game->title = $title;
					$game->priority = 500;
					$game->save();
				}

	  		//classificationに登録
	  		$game = Game::where('title', $title)->first();
				$classifications = DB::table('game_classification')->where('classification_id', 1)
																							->where('game_id', $game->id)->first();
				if (!$classifications) {
					DB::table('game_classification')->insert([
		        'game_id' => $game->id,
		        'classification_id' => 1,
					]);
				}
      }

    	//お気に入りのゲームの設定
      $storagePath = ('/public/games/');
      $storagePathName = $storagePath. 'gamesfavorite.txt';
      $contents = Storage::get($storagePathName);

      //$gamelists = [];
      $startpos = 0;
      while (mb_strpos($contents, ',', $startpos)) {
        $endpos = mb_strpos($contents, ',', $startpos);
        $title = mb_substr($contents, $startpos, $endpos - $startpos);
        $title = str_replace(array("\r\n", "\r", "\n"), '', $title);	//改行コード削除
        $startpos = $endpos +1;

        //gamesに登録
				$games = Game::where('title', $title)->first();
				if (!$games) {
					$game = new Game;
					$game->title = $title;
					$game->priority = 400;
					$game->save();
				}

	  		//classificationに登録
	  		$game = Game::where('title', $title)->first();
				$classifications = DB::table('game_classification')->where('classification_id', 2)
																							->where('game_id', $game->id)->first();
				if (!$classifications) {
					DB::table('game_classification')->insert([
		        'game_id' => $game->id,
		        'classification_id' => 2,
					]);
				}
      }

  		return back();
  		//return view('layouts.sidebar_left', compact('games'));
    }

    public function create_api()
    {
      return view('admin.create_api');
    }

    public function store_api()
    {
      //Validate the form
      $this->Validate(request(),[
        'google_key' => 'required',
        'amazon_key' => 'required',
        'amazon_secret' => 'required',
      ]);

      //Create and save the user.
      $key = Apikey::create([
      	'user_id' => '1',
        'google_key' => encrypt(request('google_key')),
        'amazon_key' => encrypt(request('amazon_key')),
        'amazon_secret' => encrypt(request('amazon_secret')),
    	]);

      //redirect to the home page.
      return redirect()->home();
    }    


}
