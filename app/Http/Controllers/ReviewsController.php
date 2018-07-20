<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Place;
use App\City;

class ReviewsController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 * review作成ページに必要なparametersを取得していく
	 */
	public function create(Request $request)
	{
		// ログイン済みかの確認
		if (\Auth::check()) {
			// ログインしているユーザー情報を取得
			$user = \Auth::user();

			if ($request->has('place_name', 'city_id', 'place_desc')) {
				// バリデーションチェック
				$this->validate($request, [
					'place_name' => 'required|max:40',
					'city_id' => 'required|integer',
					'place_desc' => 'required|max:50',
				]);
				return view('reviews.create', [
					'user' => $user,
					'request' => $request,
				]);
			} else {
				// リクエストから受け取った $place->id で 特定の place 情報を取得
				$place = Place::find($request->place);
				// dd($place);
				return view('reviews.create', [
					'user' => $user,
					'place'=> $place,
				]);
			}
		} else {
			// ログインしていないユーザーは、アクセス直前の画面に戻る（のちに構成上による変更が必要）
			return redirect()->back();
		}
	}
	/**
	 * review 入力情報を確認するための view
	 */
	public function confirm(Request $request)
	{
		// dd($request->all());
		// バリデーションチェック
		$this->validate($request, [
			'good_rating' => 'required_unless:good_comment,null,|integer',
			'bad_rating' => 'required_unless:bad_comment,null,|integer',
			//bad_comment フィールドの値が null(空＝未入力)なら このフィールドで required のバリデートを実行する|nullを許可|文字列であること|同一の内容じゃない|文字列が5文字以上（minの値は別途変更）
			'good_comment' => 'required_if:bad_comment,null,|nullable|string|unique:reviews,comment|min:5',
			'bad_comment' => 'required_if:good_comment,null,|nullable|string|unique:reviews,comment|min:5',
		]);

		$data = [
			'place' => Place::find($request->place),
			'request' => $request,
		];

		return view('reviews.confirm', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		// dd($request->all());
		// ログイン済みかの確認
		if (\Auth::check()) {
			if ($request->hasFile('photo')) {
				$validator = Validator::make($request->all(), [
					'photo' => 'bail|file|image|dimensions:max_width=1500,max_height=1500'
				]);
				if ($validator->fails()) {
					$test = $this->confirm($request)->withErrors($validator);
					return $test;
				}
			}
			// $request に place を新規登録するための各データが存在するか確認する
			if ($request->has('place_name', 'city_id', 'place_desc')) {
				// 各データが存在していれば place を新しく登録する
				$city = City::find($request->city_id);
				$place = $city->places()->create([
					'city_id' => $request->city_id,
					'name' => $request->place_name,
					'description' => $city->name.$request->place_desc,
				]);
				// 新規登録した placeのid を変数に代入する
				$placeId = $place->id;
			} else {
				// $request で受け取った placeのid を変数に代入する
				$placeId = $request->place;
			}
			//ログイン中のユーザーから review する user を取得
			$user = \Auth::user();
			// good_commentの作成保存や関係性やtypeなどを実行と 戻り値の revireインスタンスを $data 変数に代入 toReview は Usermodelに記述
			$data = $user->toReview($request, $placeId);
			// dd($data);
			// $request に photo が 存在しているかを確認
			if ($request->hasFile('photo')){
				// 存在していれば photo の画像保存等を実行 $request と $data の中に reviewインスタンスを含めて渡している　photo は UploadController に記述
				app()->make('App\Http\Controllers\UploadController')->photo($request, $data, $placeId);
			}

			// *****以下は仮設置のため今後変更の必要性あり*****
			$data = [
				'request' => $request,
			];
			return view('reviews.complete', $data);

		} else {
			// ログインしていないユーザーは、アクセス直前の画面に戻る（のちに構成上による変更が必要）
			return redirect()->back();
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
