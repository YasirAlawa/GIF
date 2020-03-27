<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//##################### Without Authentication ##############################################
Route::post('auth/login', 'AuthController@login')->name('login');



Route::prefix('user')->group(function () {
    Route::get('profile/{id}', 'UserController@userWorks');
});

//##################### End Without Authentication ##############################################



//##################### With Authentication ##############################################
Route::middleware('jwt.auth')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('logout', 'AuthController@logout');
//        Route::get('refresh', 'AuthController@refresh');
        Route::get('user', 'AuthController@me');
    });

    Route::group(['middleware' => 'jwt.refresh'], function () {
        Route::get('auth/refresh', 'AuthController@refresh');
    });

    Route::get('dashboard/counter','GeneralController@dashboard');

    Route::get('dashboard/search/{q}/{page}','GeneralController@search');

    Route::prefix('picture')->group(function () {
        Route::post('upload-image', 'PictureController@uploadImage')->name('picture');
    });

    Route::prefix('user')->group(function () {
        Route::post('get-list', 'UserController@getlist');
    });


    Route::prefix('users')->group(function () {

        Route::get('history', 'UserController@loadMyHistory');

        });
//    });
});