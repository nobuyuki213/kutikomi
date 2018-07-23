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
				// $request の中にある place の値で特定の place 情報を取得
				$place = Place::find($request->place);
				// [session]$placeインスタンスを使い review の下書き情報として session に保存
				$this->create_draft_review($request, $place);
				$d_review = $request->session()->get("draft.review{$place->id}");

				return view('reviews.create', [
					'user' => $user,
					'place'=> $place,
					'd_review' => $d_review,
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
		if ($request->has('place') || $request->has('place_name')) {
			// バリデーションチェック
			$this->validate($request, [
				'good_rating' => 'required_unless:good_comment,null,|integer',
				'bad_rating' => 'required_unless:bad_comment,null,|integer',
				//bad_comment フィールドの値が null(空＝未入力)なら このフィールドで required のバリデートを実行する|nullを許可|文字列であること|同一の内容じゃない|文字列が5文字以上（minの値は別途変更）
				'good_comment' => 'required_if:bad_comment,null,|nullable|string|unique:reviews,comment|min:5',
				'bad_comment' => 'required_if:good_comment,null,|nullable|string|unique:reviews,comment|min:5',
			]);
			// $request の中にある place の値で特定の place レコードを取得
			$place = Place::find($request->place);
			// [session]$placeレコードを使い review の下書き情報として session に追加保存
			$this->add_draft_review($request, $place);

			$data = [
				'place' => $place,
				'request' => $request,
			];

			return view('reviews.confirm', $data);
		} else {
			return redirect()->route('places.review');
		}
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
					// バリデーションエラー時の戻り先が post になっているため、ルートを通らず confirm メソッド にアクセスする
					return $this->confirm($request)->withErrors($validator);
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
			// review の作成が完了した draft review を削除する
			$request->session()->forget("draft.review{$placeId}");
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

	/**
	 * [create_draft_review description]
	 * @param  \Illuminate\Http\Request  $request
	 * @param  $place インスタンス
	 * @return [type] [description]
	 */
	public function create_draft_review(Request $request, $place)
	{
		// [session]$placeインスタンスを使い review の下書き情報として session に保存
		$is_review = $request->session()->has("draft.review{$place->id}");
		// dd($is_review);
		if ($is_review == false) {
			$request->session()->put("draft.review{$place->id}", [
				'place_id' => $place->id,
				'history_at' => now()->format('Y-m-d H:i:s'),
			]);
		}
		// $request->session()->forget("draft.review{$place->id}");
		// $request->session()->forget("draft");
	}

	/**
	 * [add_draft_review description]
	 * @param  \Illuminate\Http\Request  $request
	 * @param  $place インスタンス
	 * @return [type] [description]
	 */
	public function add_draft_review(Request $request, $place)
	{
		// dd($request->all());
		// 既に session に保存している各データを取得する
		$draft_review = $request->session()->get("draft.review{$place->id}");
		// dd($draft_review);
		// 既にある session を一旦削除する
		$request->session()->forget("draft.review{$place->id}");
		// 改めて、保存
		$request->session()->put("draft.review{$place->id}", [
			// 既に session に保存している各データを保存
			'place_id' => $draft_review['place_id'],
			'history_at' => $draft_review['history_at'],
			// 新たに追加する各データを　session に保存
			'updated_at' => now()->format('Y-m-d H:i:s'),
			'good_comment' => !empty($request->good_comment) ? $request->good_comment : '',
			'good_rating' => !empty($request->good_rating) ? $request->good_rating : '',
			'bad_comment' => !empty($request->bad_comment) ? $request->bad_comment : '',
			'bad_rating' => !empty($request->bad_rating) ? $request->bad_rating : '',
		]);
	}


}
