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

Route::get('/','HomeController@index');

Route::get('/article1', function () {
    return view('article.index');
});
Route::get('/articles', 'ArticleController@index');
Route::get('/article/{slug}', 'ArticleController@show');

Auth::routes();
Route::post('/register/email', 'Auth\RegisterController@checkEmail');
Route::post('/register/login', 'Auth\RegisterController@checkLogin');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/logout', 'HomeController@logout');
