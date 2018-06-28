<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apikey;

class VideosController extends Controller
{
    public function index() {
			return view('home');
    }

    public function search() {
    	$apikey = Apikey::where('user_id', '1')->first();
    	$googleKey = $apikey->google_key;
    	$amazonKey = $apikey->amazon_key;
    	$amazonSecret = $apikey->amazon_secret;
    	//dd($apikey);
			//Search: list
			$request_url = 'https://www.googleapis.com/youtube/v3/search?part=snippet&type=video&q=うさぎ&key='.decrypt($googleKey);
			$context = stream_context_create(array(
		      'http' => array('ignore_errors' => true)
			 ));
			$res = file_get_contents($request_url, false, $context);
			//dd($res);
			$respons = json_decode($res, false) ;
			//dd($respons);
			$items = $respons->items;
			//dd($items);
			//LBndbaDDl5s
			//www.youtube.com/embed/LBndbaDDl5s
			//Videos: list
			$request_url = 'https://www.googleapis.com/youtube/v3/videos?part=player&id=LBndbaDDl5s&key='.decrypt($googleKey);
			$context = stream_context_create(array(
		      'http' => array('ignore_errors' => true)
			 ));
			$res = file_get_contents($request_url, false, $context);
			//dd($res);
			$respons = json_decode($res, false) ;
			//dd($respons);
			$items = $respons->items;
			//dd($items);

			return view('videos.search', compact('items'));
    }
}
