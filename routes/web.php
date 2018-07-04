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
    return view('top');
});

Route::get('/home', 'GamesController@index')->name('home');
Route::get('/home/{classification}', 'GamesController@classification');

Route::get('/admin', 'AdminController@initialize');
//Route::get('/games', 'GamesController@initialize');
Route::get('/admin/api','AdminController@create_api');
//Route::get('/api/register','ApikeysController@create');
Route::post('/admin/api','AdminController@store_api');
//Route::post('/api/register','ApikeysController@store');
Route::get('/admin/gamealias','AdminController@create_gamealias');
Route::post('/admin/gamealias','AdminController@store_gamealias');

Route::get('/games/{game}', 'GamesController@show');
Route::get('/games/{game}/{video}', 'GamesController@video');
Route::post('/games/{game}', 'GamesController@sort');

Route::get('/videos/search', 'VideosController@search');

Route::get('/register','RegistrationController@create');
Route::post('/register','RegistrationController@store');
Route::get('/login','SessionController@create');
Route::post('/login','SessionController@store');
Route::get('/logout','SessionController@destroy');

