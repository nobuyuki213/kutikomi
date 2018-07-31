<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Place;
use App\City;
use App\Review;
use Session;

class PlacesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $plases = Place::all();

        return view('place', ['places' => $places]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $place = Place::find($id);
        $city = $place->city;
        $reviews_with_photos = $place->reviews_with_photos->shuffle()->all();

        $data = [
            'place' => $place,
            'city' => $city,
            'reviews_with_photos' => $reviews_with_photos,
        ];
        //session用
        //sessinoにキー名placesが存在するか確認　(true or flace)
        $is_places = $request->session()->has("places.{$place->id}");
        // dd($is_places);
        if ($is_places) {
            // session に既に保存されている place を削除する
            Session::forget("places.{$place->id}");
            // 改めて　session に place　情報を連想配列で保存する
            Session::put("places.{$place->id}", [
                // place->id から　place を特定するためのコード
                'id' => $place->id,
                // 閲覧した時間として使うためのコード
                'history_at' => now()->format('Y-m-d H:i:s'),
            ]);
        } else {
            // session に place 情報を連想配列でを保存する
            Session::put("places.{$place->id}", [
                // place->id から　place を特定するためのコード
                'id' => $place->id,
                // 閲覧した時間として使うためのコード
                'history_at' => now()->format('Y-m-d H:i:s'),
            ]);
        }
        //sessionテスト用ここまで

        return view('places.show', $data);
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
     * place show reviews page
     */
    public function reviews($id)
    {
        $place = Place::find($id);
        $city = $place->city;

        $json_reviews = Cache::remember('place'.$id.'_reviews', 30, function() use ($place){
            $data = $place->reviews()->with(['user', 'places', 'photos'])->orderBy('reviews.created_at', 'desc')->get();
            return json_encode($data);
        });
        $reviews = json_decode($json_reviews);
        // \Debugbar::info(json_decode(Cache::get('place'.$id.'_reviews')));// テスト用仮記述

        $data = [
            'city' => $city,
            'place' => $place,
            'reviews' => $reviews,
        ];

        return view('places.show_reviews', $data);
    }

    /**
     * place show photos page
     */
    public function photos($id)
    {
        $place = Place::find($id);
        $city = $place->city;
        $reviews_with_photos = $place->reviews_with_photos->all();

        $data = [
            'city' => $city,
            'place' => $place,
            'reviews_with_photos' => $reviews_with_photos,
        ];

        return view('places.show_photos', $data);
    }

    /**
     * place show map page
     */
    public function map($id)
    {
        $place = Place::find($id);
        $city = $place->city;

        $data = [
            'city' => $city,
            'place' => $place,
        ];

        return view('places.show_map', $data);
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
     * review step1-1　場所選択を名前検索で探す値の取得の実行
     * placesから複数単語のキーワード検索結果による分岐を実行
     */
    public function multiSearch(Request $request)
    {
        $places = Place::search($request);
        $message = $places['message'];
        $places = $places['places'];
        // review する place を新規登録する際に city 選択用で使うために取得
        $select_cities = City::orderBy('name_furi')->get();

        if($message) {
            // 検索結果が該当しない場合=messageが存在する場合true
            return view('places.review', [
                'places' => $places,
                'keywords' =>array_merge($request->input(), $request->session()->getOldInput()),
                'message' => $message,
                'select_cities' => $select_cities,
            ]);
        } else {
            return view('places.review', [
                'places' => $places,
                'keywords' =>array_merge($request->input(), $request->session()->getOldInput()),
                'select_cities' => $select_cities,
            ]);
        }
    }
    /*
    * review step1-2 場所選択を住所から探すcitiesの取得
     */
    public function searchAdd(Request $request)
    {
        // dd($request->key_id);
        // review する place を新規登録の際に city 選択用で使うために取得
        $select_cities = City::orderBy('name_furi')->get();

        if ($request->city != null) {
            $city = City::find($request->city);
            $places = $city->places()->paginate(5);

            return view('places.search_add', [
                'places' => $places,
                'select_cities' => $select_cities,
            ]);
        }

        $cities = City::paginate(10);

        return view('places.search_add', [
            'cities' => $cities,
            'select_cities' => $select_cities,
        ]);
    }

    /**
     * [draft description] review step1-3 場所選択を下書きの履歴から探す
     * @return [type] [description]
     */
    public function draft(Request $request)
    {
        // draftreviews の並び順を　session を新しく保存した順にするため、collectヘルパと reverseメソッドを使い逆順にする
        $draft_reviews = collect($request->session()->get('draft'))->reverse();
        // pagination の設定
        $perPage = 10; //1ページに表示するレコード数
        $d_reviews = $this->custom_paginate($draft_reviews, $perPage);

        return view('places.draft', [
            'd_reviews' => $d_reviews,
        ]);
    }
}
