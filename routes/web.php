<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'VideosController@index')->name('home');
/*
Route::get('/games', function(){
  for ($page=0; $page < 100; $page++) {
  		$queue[0] = new \App\Jobs\AmazonGameJob($page);
  		$this->dispatch(new \App\Jobs\AmazonGameJob($page));
  		//Queue::push($queue[0]);
  		//Queue::push(new \App\Jobs\AmazonGameJob($page));
  }
});
*/
Route::get('/games', 'AmazonsController@index');

Route::get('/videos/search', 'VideosController@search');

Route::get('/register','RegistrationController@create');
Route::post('/register','RegistrationController@store');
Route::get('/login','SessionController@create');
Route::post('/login','SessionController@store');
Route::get('/logout','SessionController@destroy');

Route::get('/api/register','ApikeysController@create');
Route::post('/api/register','ApikeysController@store');
