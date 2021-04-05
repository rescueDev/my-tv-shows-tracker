<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//Navigation routes user logged
Route::get('/progress', function () {
    return view('progress');
})->middleware('auth');

Route::get('/discover', function () {
    return view('discover');
})->middleware('auth');

Route::get('/profile', function () {
    return view('profile');
})->middleware('auth');

Route::get('/progress', 'ShowController@index');
Route::post('/shows', 'ShowController@store');

//show serie
Route::get('/show/{id}', 'ShowController@show')->name('show-serie');

//show watched serie
Route::get('/watched/show/{id}', 'ShowController@showWatched')->name('show-watched-serie');

// mark as watched episode
Route::post('/show/ep/{id}/check' , 'EpisodeController@update')->name('check-episode');

//watched series
Route::get('/watched', 'ShowController@watched')->name('watched');

//make a show all watched in one click
Route::post('/watched/show/{id}', 'ShowController@update')->name('watched-show');


//delete show
Route::delete('/show/{id}', 'ShowController@destroy')->name('delete-show');
