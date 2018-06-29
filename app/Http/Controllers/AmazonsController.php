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
  	/*
  	//Production code
  	$page = 1;
		$this->dispatch(new AmazonGameJob($page));
		*/

		return view('/home');
		//return view('layouts.sidebar_left', compact('res'));
	}

  public function search()
  {
	}

}
