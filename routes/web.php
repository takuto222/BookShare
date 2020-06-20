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

Auth::routes();
Route::get('/', 'ArticleController@index')->name('articles.index');
Route::resource('/articles', 'ArticleController')->except(['index', 'show'])->middleware('auth');
Route::resource('/articles', 'ArticleController')->only(['show']);

// いいね、ブックマーク機能のルーティング
Route::prefix('articles')->name('articles.')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::post('/{article}/review', 'ArticleController@review')->name('review');
        Route::put('/{article}/like', 'ArticleController@like')->name('like');
        Route::delete('/{article}/like', 'ArticleController@unlike')->name('unlike');
        Route::put('/{article}/bookmark', 'ArticleController@bookmark')->name('bookmark');
        Route::delete('/{article}/bookmark', 'ArticleController@unbookmark')->name('unbookmark');
    });
});

// ユーザページ用のルーティング
Route::prefix('users')->name('users.')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/{user}/edit', 'UserController@edit')->name('edit');
        Route::post('/{user}', 'UserController@update')->name('update');
        Route::put('/{name}/follow', 'UserController@follow')->name('follow');
        Route::delete('/{name}/follow', 'UserController@unfollow')->name('unfollow');
    });
    Route::get('/{name}', 'UserController@show')->name('show');
    Route::get('/{name}/followings', 'UserController@followings')->name('followings');
    Route::get('/{name}/followers', 'UserController@followers')->name('followers');
});
