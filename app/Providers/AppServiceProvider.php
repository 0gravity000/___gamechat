<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Schema::defaultStringLength(191);

      view()->composer('layouts.home', function($view) {
        $Games = \App\Game::all();
        $Game = $Games->random();
        $game = \App\Game::where('title', $Game->title)->first();
        //タイトルにスペースを含むとレスポンスにがNullになるの + に置換する
        $Game->title = str_replace(array(" ", "  ", "　"), '+', $Game->title); //改行コード削除
        //タイトルにスペースや記号を含むとレスポンスにがNullになるので取る
        //$title = str_replace(array(" ", "  ", "　","(",")","ｰ" ,"－"), '', $title); //改行コード削除
        $apikey = \App\Apikey::where('user_id', '1')->first();
        $googleKey = $apikey->google_key;
        $amazonKey = $apikey->amazon_key;
        $amazonSecret = $apikey->amazon_secret;
        //dd($apikey);
        //Search: list
        $request_url = 'https://www.googleapis.com/youtube/v3/search?part=snippet&type=video&videoCategoryId=20&maxResults=5&q='.$Game->title.'&key='.decrypt($googleKey);
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
        $view->with(compact('game', 'gameitems'));
      });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
