<?php

declare(strict_types=1);

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

// SNSログインボタンからのリンク
Route::get('/login/{social}', 'Auth\LoginController@socialLogin')->where('social', 'facebook|google');

// コールバック用
Route::get('/login/{social}/callback', 'Auth\LoginController@handleProviderCallback')->where('social', 'facebook|google');

Route::middleware(['auth'])->group(function (): void {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/about', 'AboutController@index')->name('about');

    Route::get('/graph', 'GraphController@index')->name('graph');

    Route::get('/word-search', 'SearchController@wordSearch')->name('word-search');

    Route::get('/value-search', 'SearchController@valueSearch')->name('value-search');

    Route::get('/date-search', 'SearchController@dateSearch')->name('date-search');

    Route::resources([
        'posts' => 'PostsController',
        'values' => 'ValuesController',
        'users' => 'UsersController',
    ]);

    Route::get('/trashed-posts', 'PostsController@trashed')->name('trashed-posts.index');

    Route::post('/restore/{post}', 'PostsController@restoreTrashedPost')->name('posts.restore');

    Route::post('/trashed-posts/clear', 'PostsController@clearTrashedPost')->name('trashed-posts.clear');
});
