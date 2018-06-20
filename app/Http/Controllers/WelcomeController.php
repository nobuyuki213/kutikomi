<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Place;

class WelcomeController extends Controller
{
	//
	public function index()
	{
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

		$data = [
			'cities' => $cities,
			'lines' => $lines,
		];

		return view('welcome', $data);
	}
}
