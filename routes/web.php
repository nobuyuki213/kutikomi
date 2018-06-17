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

// サインイン/ログインページ
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login.get');
// サインイン実行
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
// ログイン実行
Route::post('login', 'Auth\LoginController@login')->name('login.post');
// ログアウト実行
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');