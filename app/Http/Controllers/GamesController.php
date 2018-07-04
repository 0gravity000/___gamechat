<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apikey;
use App\Game;
use App\Classification;
use App\Gamealias;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class GamesController extends Controller
{
    public function index() {
    	//AppServiceProviderでSidebar_leftに$gamesを渡す
  		$games = Game::all()->sortBy('title');
  		return view('layouts.sidebar_left', compact('games'));
    }

    public function classification($Classification) {
    	//dd($classification);
  		$Classid = 1;
    	if ($Classification == 'amazon') {
    		$Classid = 1;
    	} elseif($Classification == 'favorite') {
    		$Classid = 2;
    	}

    	$classification = Classification::where('id', $Classid)->first();
	   	//dd($classification);
	   	$games = $classification->games;
	   	//dd($games);
  		$games = $games->sortBy('title');
  		return view('layouts.sidebar_left', compact('games'));
    }

    public function show($title) {
			$game = Game::where('title', $title)->first();
			//タイトルにスペースを含むとレスポンスにがNullになるの + に置換する
      $title = str_replace(array(" ", "  ", "　"), '+', $title);	//改行コード削除
			//タイトルにスペースや記号を含むとレスポンスにがNullになるので取る
      //$title = str_replace(array(" ", "  ", "　","(",")","ｰ" ,"－"), '', $title);	//改行コード削除
    	$apikey = Apikey::where('user_id', '1')->first();
    	$googleKey = $apikey->google_key;
    	$amazonKey = $apikey->amazon_key;
    	$amazonSecret = $apikey->amazon_secret;
    	//dd($apikey);
			//Search: list
			$request_url = 'https://www.googleapis.com/youtube/v3/search?part=snippet&type=video&videoCategoryId=20&maxResults=50&q='.$title.'&key='.decrypt($googleKey);
    	//dd($request_url);
			$context = stream_context_create(array(
		      'http' => array('ignore_errors' => true)
			 ));
			$res = file_get_contents($request_url, false, $context);
			//dd($res);
			$respons = json_decode($res, false) ;
			//dd($respons);
			$gameitems = $respons->items;
			//dd($gameitems);
			$aliases = $game->gamealises;
			//dd($aliases);
  		return view('games.index', compact('game', 'gameitems', 'aliases'));

    	/*
			//$game = Game::where('title', $title)->first();
			//dd($game->title);
			//$title = $game->title;
			//タイトルにスペースや記号を含むとレスポンスにがNullになるので取る
      $title = str_replace(array(" ", "  ", "　","(",")","ｰ" ,"－"), '', $title);	//改行コード削除

    	$apikey = Apikey::where('user_id', '1')->first();
    	$googleKey = $apikey->google_key;
    	$amazonKey = $apikey->amazon_key;
    	$amazonSecret = $apikey->amazon_secret;
    	//dd($apikey);
			//Search: list
			$request_url = 'https://www.googleapis.com/youtube/v3/search?part=snippet&type=video&q='.$title.'&key='.decrypt($googleKey);
			$context = stream_context_create(array(
		      'http' => array('ignore_errors' => true)
			 ));
			$res = file_get_contents($request_url, false, $context);
			//dd($res);
			$respons = json_decode($res, false) ;
			//dd($respons);
			$items = $respons->items;
			//dd($items);

			$videoId_array = [];
			foreach ($items as $key => $item) {
        $params = array(
          "videoid" => $item->id->videoId,
        );
        //var_dump($params);
        array_push($videoId_array, $params);
			}
			//dd($videoId_array);


			//LBndbaDDl5s
			//www.youtube.com/embed/LBndbaDDl5s
			//Videos: list
			//$request_url = 'https://www.googleapis.com/youtube/v3/videos?part=player&id=LBndbaDDl5s&key='.decrypt($googleKey);
			$context = stream_context_create(array(
		      'http' => array('ignore_errors' => true)
			 ));
			$videoPlayers_array = [];
			for ($i=0; $i < count($videoId_array); $i++) { 
				$request_url = 'https://www.googleapis.com/youtube/v3/videos?part=player&id='.array_get($videoId_array[$i], 'videoid').'&key='.decrypt($googleKey);
				$res = file_get_contents($request_url, false, $context);
				//dd($res);
				$respons = json_decode($res, false) ;
				//dd($respons);
				$items = $respons->items;
				//dd($items);
				foreach ($items as $key => $item) {
	        $params = array(
	          "player" => $item->player->embedHtml,
	        );
	        //var_dump($params);
	        array_push($videoPlayers_array, $params);
				}
			}
			//dd($videoPlayers_array);
  		return view('games.index', compact('videoPlayers_array'));
			*/
    }

    public function sort($title) {
    	//dd($title);
    	//dd(request());
    	//dd('stop');
			$game = Game::where('title', $title)->first();

			if(request()->alias != 'none'){
				$title = request()->alias;
			}
			//タイトルにスペースを含むとレスポンスにがNullになるの + に置換する
      $title = str_replace(array(" ", "  ", "　"), '+', $title);	//改行コード削除
			//タイトルにスペースや記号を含むとレスポンスにがNullになるので取る
      //$title = str_replace(array(" ", "  ", "　","(",")","ｰ" ,"－"), '', $title);	//改行コード削除
      $keyword = '';
      if(request()->keyword){
	      $keyword = str_replace(array(" ", "  ", "　"), '+', request()->keyword);	//改行コード削除
      }

    	$apikey = Apikey::where('user_id', '1')->first();
    	$googleKey = $apikey->google_key;
    	$amazonKey = $apikey->amazon_key;
    	$amazonSecret = $apikey->amazon_secret;
    	//dd($apikey);
			//Search: list
			$request_url = 'https://www.googleapis.com/youtube/v3/search?part=snippet&type=video&videoCategoryId=20&maxResults=50&order='.request()->order.'&q='.$title.'+'.$keyword.'&videoCaption='.request()->videoCaption.'&key='.decrypt($googleKey);
    	//dd($request_url);
			$context = stream_context_create(array(
		      'http' => array('ignore_errors' => true)
			 ));
			$res = file_get_contents($request_url, false, $context);
			//dd($res);
			$respons = json_decode($res, false) ;
			//dd($respons);
			$gameitems = $respons->items;
			//dd($gameitems);
			$aliases = $game->gamealises;
			//dd($aliases);
  		return view('games.index', compact('game', 'gameitems','aliases'));
    }

    public function video($title, $video) {

    	$apikey = Apikey::where('user_id', '1')->first();
    	$googleKey = $apikey->google_key;

    	//パラメータ値に指定できる part 名は、id、 snippet、 contentDetails、 fileDetails、 liveStreamingDetails、 player、 processingDetails、 recordingDetails、 statistics、 status、 suggestions、 topicDetails などです。
    	//videoid t3cLDDwLeJA
			$request_url = 'https://www.googleapis.com/youtube/v3/videos?part=player,snippet,contentDetails&id='.$video.'&key='.decrypt($googleKey);
			$context = stream_context_create(array(
		      'http' => array('ignore_errors' => true)
			 ));
			$res = file_get_contents($request_url, false, $context);
			//dd($res);
			$respons = json_decode($res, false) ;
			//dd($respons);
			$videoitems = $respons->items;
			//dd($items);
			/*
			$videoPlayers_array = [];
			foreach ($items as $key => $item) {
        $params = array(
          "player" => $item->player->embedHtml,
        );
        //var_dump($params);
        array_push($videoPlayers_array, $params);
			}
			//dd($videoPlayers_array);
			*/
			$game = Game::where('title', $title)->first();
  		return view('games.video', compact('game', 'videoitems'));
    }

}
