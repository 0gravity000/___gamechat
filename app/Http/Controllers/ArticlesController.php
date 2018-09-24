<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;

class ArticlesController extends Controller
{
    public function Windows10_PC_Fate_Stay_night() {
  		return view('articles.Windows10_PC_Fate_Stay_night');
  		//$games = Game::all()->sortBy('title');
  		//$articlename = 'Windows10_PC_Fate_Stay_night';
  		//return view('layouts.articlemaster', compact('articlename'));
  		//return view('articles.Windows10_PC_Fate_Stay_night', compact('games'));
    }

}
