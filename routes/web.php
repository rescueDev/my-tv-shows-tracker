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

// mark as watched episode
Route::post('/show/ep/{id}/check' , 'EpisodeController@update')->name('check-episode');
