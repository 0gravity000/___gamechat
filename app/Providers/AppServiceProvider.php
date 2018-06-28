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

      view()->composer('layouts.sidebar_left', function($view) {
      //view()->composer('layouts.tags_left', function($view) {
      //view()->composer('posts.index', function($view) {
        $archives = \App\Post::archives();
        $tags = \App\Tag::orderByRaw('priority ASC')->get();
        //$tags = \App\Tag::all();
        $categories = \App\Category::orderByRaw('priority ASC')->get();
        //$categories = \App\Category::orderByRaw('priority DESC')->get();
        //$categories = $categories
        $category_tags = DB::table('category_tag')->get();
        //$tags = \App\Tag::has('posts')->pluck('name');
        $view->with(compact('archives', 'tags', 'categories', 'category_tags'));
      });

      view()->composer('layouts.nav', function($view) {
        $tags_favorite = \App\Tag::orderBy('priority', 'asc')->take(10)->get();
        $posts_favorite = \App\Post::orderBy('priority', 'asc')->take(10)->get();
        $posts_recently = \App\Post::orderBy('updated_at', 'desc')->take(10)->get();

        $view->with(compact('tags_favorite', 'posts_favorite', 'posts_recently'));
      });

      view()->composer('layouts.home_sidebar_left', function($view) {
        $games = \App\Game::orderBy('priority', 'asc')->take(10)->get();

        $view->with(compact('games'));
      });
      view()->composer('layouts.home_sidebar_middle', function($view) {
        $charactors = \App\Character::orderBy('priority', 'asc')->take(10)->get();

        $view->with(compact('charactors'));
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
