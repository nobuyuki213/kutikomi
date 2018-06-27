<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Place;
use App\Tag;
use Session;

class WelcomeController extends Controller
{
	//
	public function index()
	{
		// city名50音順別で取得
		$lines = ['あ', 'か', 'さ', 'た', 'な', 'は', 'ま', 'や', 'ら', 'わ',];
		$city = City::LineA()->get(); //あ行取得（ローカルスコープ
		$cities[] = $city;
		$city = City::LineKa()->get(); //か行取得（ローカルスコープ
		$cities[] = $city;
		$city = City::LineSa()->get(); //さ行取得（ローカルスコープ
		$cities[] = $city;
		$city = City::LineTa()->get(); //た行取得（ローカルスコープ
		$cities[] = $city;
		$city = City::LineNa()->get(); //な行取得（ローカルスコープ
		$cities[] = $city;
		$city = City::LineHa()->get(); //は行取得（ローカルスコープ
		$cities[] = $city;
		$city = City::LineMa()->get(); //ま行取得（ローカルスコープ
		$cities[] = $city;
		$city = City::LineYa()->get(); //や行取得（ローカルスコープ
		$cities[] = $city;
		$city = City::LineRa()->get(); //ら行取得（ローカルスコープ
		$cities[] = $city;
		$city = City::LineWa()->get(); //わ行取得（ローカルスコープ
		$cities[] = $city;
		// 全てのtagを取得
		$tags = Tag::all();

		$data = [
			'cities' => $cities,
			'lines' => $lines,
			'tags' => $tags,
		];

		return view('welcome', $data);
	}

	// sessionテスト用ここから

	public function historyGet(Request $request)
	{
		$id = $request->session()->getId();
		$s_places = $request->session()->all();
		// Session::forget('place');
		return view('history', ['s_places' => $s_places, 'id' => $id]);
	}

	public function search_put(Request $request)
	{
		$keyword = $request->keyword;
		$request->session()->put('keyword', $keyword);
		return redirect('/session'); //本番はページ遷移はしない
	}

		// sessionテスト用ここまで
}
