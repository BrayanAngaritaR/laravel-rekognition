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

Route::get('text', 'Rekognition\TextController@index')->name('text');
Route::post('text', 'Rekognition\TextController@submitForm')->name('text.submit');

Route::get('nudity', 'Rekognition\NudityController@index')->name('nudity');
Route::post('nudity', 'Rekognition\NudityController@submitForm')->name('nudity.submit');
