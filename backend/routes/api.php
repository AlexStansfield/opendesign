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
    Route::get('brief/{id}/designs', 'BriefController@getDesigns');
//});

/**
 * Auth
 */
Route::post('/auth', 'AuthController@auth');
Route::get('/auth/test', 'AuthController@test')->middleware('auth:api');


/*
 * Design
 */
Route::prefix('design')->group(function () {
    Route::get('/', 'DesignController@getAll');
    Route::post('/', 'DesignController@create')->middleware('auth:api');
    Route::get('/{id}', 'DesignController@getOne');
    Route::put('/{id}', 'DesignController@update')->middleware('auth:api');
    Route::delete('/{id}', 'DesignController@delete')->middleware('auth:api');
    Route::get('{id}/brief', 'DesignController@showBrief');
    Route::get('{id}/likes', 'DesignController@getLikes');
    Route::post('{id}/like', 'DesignController@addLike')->middleware('auth:api');
    Route::delete('{id}/like', 'DesignController@removeLike')->middleware('auth:api');
    Route::get('{id}/comments', 'DesignController@getComments');
});
/**
 * Design Likes
 */

/**
 * Design Comments
 */

/**
 * Comments
 */
Route::post('/comment', 'CommentController@create')->middleware('auth:api');
Route::put('/comment/{id}', 'CommentController@update')->middleware('auth:api');
Route::delete('/comment/{id}', 'CommentController@delete')->middleware('auth:api');

/**
 * Project
 */
Route::get('/project', 'ProjectController@getAll');
Route::get('/project/{id}', 'ProjectController@getOne');
Route::post('/project', 'ProjectController@create')->middleware('auth:api');


