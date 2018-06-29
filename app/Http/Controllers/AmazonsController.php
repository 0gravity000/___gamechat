<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apikey;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Jobs\AmazonGameJob;

class AmazonsController extends Controller
{
  public function index()
  {
  	$page = 1;
  	//$min = 1;
  	//$max = 5;
		$this->dispatch(new AmazonGameJob($page));

		/*
		//1度に取得できるのは10個なので、以降はページを指定して、繰り返す。
		//max100ページとする
		//dd('stop');
	  for ($page=1; $page < 100; $page++) {
	  		$queue[$page] = new AmazonGameJob($page);
	  		$this->dispatch($queue[$page]);
	  		//Queue::push($queue[0]);
	  		//Queue::push(new \App\Jobs\AmazonGameJob($page));
	  }
		*/

		return view('/home');
		//return view('layouts.sidebar_left', compact('res'));
	}

  public function search()
  {
	}

}
