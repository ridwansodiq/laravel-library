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

Route::get('/', [
        'uses' => 'BookController@getBookHome',
        'as' => 'book.list'
    ]);

Route::get('ajax/books', [
    'uses' => 'BookController@getBooks',
    'as' => 'book.ajax.list'
]);

Route::post('ajax/books', [
    'uses' => 'BookController@postBooks',
    'as' => 'book.ajax.list'
]);

Route::get('book/{book}', [
    'uses' => 'BookController@getBook',
    'as' => 'book.index'
]);
Route::post('review/create/{book}', [
    'uses' => 'ReviewController@postReview',
    'as' => 'review.create'
]);
    
Route::group(['middleware' => ['web']], function() {
// Login Routes...
    Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
    Route::post('login', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);
    Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

// Registration Routes...
    Route::get('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
    Route::post('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@register']);
});
    

Route::group(['middleware' => ['auth']], function () {

    Route::get('create', [
        'uses' => 'BookController@getCreateBook',
        'as' => 'book.create'
    ]);
    Route::post('create', [
        'uses' => 'BookController@postCreateBook',
        'as' => 'book.create'
    ]);
});    

