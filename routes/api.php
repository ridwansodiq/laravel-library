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


Route::group(['prefix' => 'v1'], function ($router) {
    Route::post('login', 'Api\AuthController@login');
    Route::group(['middleware' => 'auth:api'], function () {        
        Route::get('logout', 'Api\AuthController@logout');
        Route::post('refresh', 'Api\AuthController@refresh');
        Route::get('user', 'Api\AuthController@me');
        Route::get('books','Api\BookController@getBooks');
        Route::get('book/{book}','Api\BookController@getBook');
        Route::post('book','Api\BookController@postAddBook');
        Route::post('review/create/{book}','Api\ReviewController@postAddReview');
        Route::get('categories','Api\CategoryController@getCategories');
    });
});
