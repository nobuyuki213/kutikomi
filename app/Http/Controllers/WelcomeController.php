<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\City;
use App\Place;
use App\Tag;
use App\Review;
use Session;

class WelcomeController extends Controller
{
	//
	public function index()
	{
		// city名50音順別で取得
		$lines = ['あ', 'か', 'さ', 'た', 'な', 'は', 'ま', 'や', 'ら', 'わ',];
		$city = City::with('places')->LineA()->get(); //あ行取得（ローカルスコープ
		$cities[] = $city;
		$city = City::with('places')->LineKa()->get(); //か行取得（ローカルスコープ
		$cities[] = $city;
		$city = City::with('places')->LineSa()->get(); //さ行取得（ローカルスコープ
		$cities[] = $city;
		$city = City::with('places')->LineTa()->get(); //た行取得（ローカルスコープ
		$cities[] = $city;
		$city = City::with('places')->LineNa()->get(); //な行取得（ローカルスコープ
		$cities[] = $city;
		$city = City::with('places')->LineHa()->get(); //は行取得（ローカルスコープ
		$cities[] = $city;
		$city = City::with('places')->LineMa()->get(); //ま行取得（ローカルスコープ
		$cities[] = $city;
		$city = City::with('places')->LineYa()->get(); //や行取得（ローカルスコープ
		$cities[] = $city;
		$city = City::with('places')->LineRa()->get(); //ら行取得（ローカルスコープ
		$cities[] = $city;
		$city = City::with('places')->LineWa()->get(); //わ行取得（ローカルスコープ
		$cities[] = $city;
		// 全てのtagを取得
		$tags = Tag::all();
		$reviews = Review::with('user')->latest()->take(10)->get();

		$data = [
			'cities' => $cities,
			'lines' => $lines,
			'tags' => $tags,
			'reviews' => $reviews,
		];

		return view('welcome', $data);
	}

	/**
	 * [historyGet places history view]
	 * @param  Request $request [session]
	 * @return [type]           [history view]
	 */
	public function historyGet(Request $request)
	{
		$id = $request->session()->getId();// sessionidを取得するコード※現状使用なし

		if ($request->session()->has('places')) {
			// places の並び順を　session 新しく保存した順にするため、collectヘルパと reverseメソッドを使い逆順にする
			$ses_places = collect($request->session()->get('places'))->reverse();
			// 空の $s_places 配列を準備　
			$s_places = [];
			foreach ($ses_places as $key => $ses_place) {
				// session に保存した id から place を特定し、mergeメソッド
				$s_place = collect(Place::find($ses_place['id']));
				// session に保存した history_at を連想配列で　place に追加する
				$s_places[] = $s_place->merge(['history_at' => $ses_place['history_at']])->all();
			}
			// pagination の実装のため、 collectヘルパを使い、collectionクラスにする
			$s_places = collect($s_places);
			// paginetion の設定
			$perPage = 10; //1ページに表示するレコード数
			$s_places = $this->custom_paginate($s_places, $perPage);

			return view('histories.history', [
				's_places' => $s_places,
				'id' => $id,
				// 'places' => $places,
			]);
		} else {

			return view('histories.history');
		}
	}

	/**
	 * [searchGet searwords history view]
	 * @param  Request $request [session]
	 * @return [type]           [history view]
	 */
	public function searchGet(Request $request)
	{
		if ($request->session()->has('searchwords')) {
			// searchwords の並び順を　session 新しく保存した順にするため、collectヘルパと reverseメソッドを使い逆順にする
			$s_searchwords = collect($request->session()->get('searchwords'))->reverse();
			// pagination の設定
			$perPage = 10; //1ページに表示するレコード数
			$s_searchwords = $this->custom_paginate($s_searchwords, $perPage);

			return view('histories.history_search', [
				's_searchwords' => $s_searchwords,
			]);
		} else {

			return view('histories.history_search');
		}
	}
}
