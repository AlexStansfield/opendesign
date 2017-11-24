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

//Route::group(['middleware' => 'auth'], function()
//{
    Route::get('brief', 'BriefController@index');
    Route::get('brief/{article}', 'BriefController@show');
    Route::post('brief', 'BriefController@store');
    Route::put('brief/{article}', 'BriefController@update');
    Route::delete('brief/{article}', 'BriefController@delete');
//});

/**
 * Auth
 */
Route::post('/auth', 'AuthController@auth');
Route::get('/auth/test', 'AuthController@test')->middleware('auth:api');

/**
 * Design Likes
 */
Route::get('/design/{id}/likes', 'DesignController@getLikes');
Route::post('/design/{id}/like', 'DesignController@addLike')->middleware('auth:api');
Route::delete('/design/{id}/like', 'DesignController@removeLike')->middleware('auth:api');

/**
 * Design Comments
 */
Route::get('/design/{id}/comments', 'DesignController@getComments');

/**
 * Comments
 */
Route::post('/comment', 'CommentController@create')->middleware('auth:api');
Route::put('/comment/{id}', 'CommentController@update')->middleware('auth:api');
Route::delete('/comment/{id}', 'CommentController@delete')->middleware('auth:api');

