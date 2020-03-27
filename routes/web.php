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

Route::get('/botman' , 'BotmanController@index')->name('botman.index');
Route::get('{any}/{id?}', 'GeneralController@index')->where('any', '^(?!api\/)[\/\w\.-]*');
//Route::get('{any}', function () {
//    return view('index');
//})->where('any', '^(?!api\/)[\/\w\.-]*');

//Route::get('/', function () {
//    return view('index');
//});
