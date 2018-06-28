<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apikey;

class GamesController extends Controller
{
    public function index() {
    	$apikey = Apikey::where('user_id', '1')->first();
    	$apikey = $apikey->key;
    	//dd($apikey);
			//Search: list
			$request_url = 'https://www.googleapis.com/youtube/v3/search?part=id,snippet&id=15'.$apikey;
			/*
			$request_url = 'https://www.googleapis.com/youtube/v3/videos?part=player,id,snippet&id=243vDA7Zgq4&key='.$apikey;

			$request_url = 'https://www.googleapis.com/youtube/v3/search?part=id,snippet&channelId=UCBR8-60-B28hp2BmDPdntcQ&order=viewCount&key='.$apikey;

			$request_url = 'https://www.googleapis.com/youtube/v3/guideCategories?part=id,snippet&regionCode=JP&key='.$apikey;

  	5 => {#210 ▼
      +"kind": "youtube#guideCategory"
      +"etag": ""DuHzAJ-eQIiCIp7p4ldoVcVAOeY/81fHLyWLDYMN1EQqlz89HXIdMs4""
      +"id": "GCR2FtaW5n"
      +"snippet": {#211 ▼
        +"channelId": "UCBR8-60-B28hp2BmDPdntcQ"
        +"title": "Gaming"
      }
    }

			$request_url = 'https://www.googleapis.com/youtube/v3/videoCategories?part=id,snippet&regionCode=JP&key='.$apikey;

    +"kind": "youtube#videoCategory"
      +"etag": ""DuHzAJ-eQIiCIp7p4ldoVcVAOeY/WmA0qYEfjWsAoyJFSw2zinhn2wM""
      +"id": "20"
      +"snippet": {#215 ▼
        +"channelId": "UCBR8-60-B28hp2BmDPdntcQ"
        +"title": "Gaming"
        +"assignable": true
			*/

			$context = stream_context_create(array(
		      'http' => array('ignore_errors' => true)
			 ));
			$res = file_get_contents($request_url, false, $context);
			$respons = json_decode($res, false) ;
			dd($respons);
			$items = $respons->items;
			//dd($items);
			//LBndbaDDl5s
			//www.youtube.com/embed/LBndbaDDl5s
			//Videos: list
			$request_url = 'https://www.googleapis.com/youtube/v3/videos?part=player&id=LBndbaDDl5s&key='.$apikey;
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

			return view('home');
    }
}
