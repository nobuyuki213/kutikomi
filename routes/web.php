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
Route::get('recent/history', 'WelcomeController@historyGet')->name('history.places');
//placeの検索履歴保存（本番はこのルーティン名は不要になると思われるが作成によって使える可能性もあるので保留）
Route::get('recent/search', 'WelcomeController@searchGet')->name('history.search');
 //session利用ここまで

// top
Route::get('/', 'WelcomeController@index')->name('top');

// サインイン/ログインページ
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
// サインイン実行
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
// ログイン実行
Route::post('login', 'Auth\LoginController@login')->name('login.post');
// ログアウト実行
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

// ソーシャル登録＆ログインの実装
Route::get('login/{provider}', 'Auth\SocialAccountController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\SocialAccountController@handleProviderCallback');

// user
Route::group(['middleware' => ['auth']], function(){
	Route::resource('users', 'UsersController', ['only' => ['show']]);
	Route::post('profile', 'UploadController@updateAvatar')->name('update.avatar');

	Route::group(['prefix' => 'users/{id}'], function(){
		Route::post('favorite', 'UserFavoriteController@store')->name('user.favorite');
		Route::delete('unfavorite', 'UserFavoriteController@destroy')->name('user.unfavorite');

	});
});
// search
Route::get('search', 'SearchController@search')->name('search');

Route::group(['prefix' => 'hirosima'], function(){
	Route::resource('cities', 'CitiesController', ['only' => ['show']]);
});

Route::group(['prefix' => 'hirosima/cities'], function(){
	Route::resource('places', 'PlacesController', ['only' => ['index', 'show']]);
	Route::get('places/{id}/photos', 'PlacesController@photos')->name('place.photos');
	Route::get('places/{id}/map', 'PlacesController@map')->name('place.map');
	//ログイン認証必要ルーティン
	Route::group(['middleware' => ['auth']], function (){
		Route::get('places/{id}/reviews', 'PlacesController@reviews')->name('place.reviews');
	});

});

Route::resource('tags', 'TagsController', ['only' => ['index', 'show']]);

// レビュー
Route::group(['prefix' => 'places/review'], function(){
	Route::get('input/search', 'PlacesController@multiSearch')->name('places.review');
	Route::get('input/search_add', 'PlacesController@searchAdd')->name('places.search_add');
	//以下のレビュー登録ページへはのちに会員遷移できないよう Route::group(['middleware' => ['auth']], function () {    });を追加する※上記の search のルーティングも含めるか要検討
	Route::group(['middleware' => ['auth']], function () {
		Route::resource('reviews', 'ReviewsController', ['only' => ['create', 'store']]);
		Route::post('reviews/confirm', 'ReviewsController@confirm')->name('reviews.confirm');
	});
});