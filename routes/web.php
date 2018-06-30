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
// テスト用
Route::get('test', function(){
	return view('test');
});
//session利用
//placeの閲覧履歴ページ
Route::get('history', 'WelcomeController@historyGet')->name('history.get');
//placeの検索履歴保存（本番はこのルーティン名は不要になると思われるが作成によって使える可能性もあるので保留）
Route::post('session', 'WelcomeController@session_put')->name('session.post');
 //session利用ここまで

Route::get('/', 'WelcomeController@index')->name('top');

// サインイン/ログインページ
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login.get');
// サインイン実行
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
// ログイン実行
Route::post('login', 'Auth\LoginController@login')->name('login.post');
// ログアウト実行
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

// ソーシャル登録＆ログインの実装
Route::get('login/{provider}', 'Auth\SocialAccountController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\SocialAccountController@handleProviderCallback');

Route::group(['prefix' => 'hirosima'], function(){
	Route::resource('cities', 'CitiesController', ['only' => ['show']]);
});

Route::group(['prefix' => 'hirosima/cities'], function(){
	Route::resource('places', 'PlacesController', ['only' => ['index', 'show']]);
});

Route::resource('tags', 'TagsController', ['only' => ['index', 'show']]);

// レビュー
Route::group(['prefix' => 'places/review/input'], function(){
	Route::get('search', 'PlacesController@multiSearch')->name('places.review');
	Route::get('search_add', 'PlacesController@searchAdd')->name('places.search_add');

});