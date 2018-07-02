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
    return view('/welcome');
});

Route::get('/home', 'GamesController@index')->name('home');
Route::get('/home/{classification}', 'GamesController@classification');
Route::get('/games', 'GamesController@initialize');
Route::get('/games/{game}', 'GamesController@show');
Route::get('/games/{game}/{video}', 'GamesController@video');
Route::post('/games/{game}', 'GamesController@sort');

Route::get('/videos/search', 'VideosController@search');

Route::get('/register','RegistrationController@create');
Route::post('/register','RegistrationController@store');
Route::get('/login','SessionController@create');
Route::post('/login','SessionController@store');
Route::get('/logout','SessionController@destroy');

Route::get('/api/register','ApikeysController@create');
Route::post('/api/register','ApikeysController@store');
