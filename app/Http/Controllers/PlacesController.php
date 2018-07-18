<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $city = $place->city()->get();
        $reviews_with_photos = $place->reviews_with_photos()->shuffle()->all();

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
        $reviews = $place->reviews_latest()->get();

        $data = [
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
        $reviews_with_photos = $place->reviews_with_photos();

        $data = [
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

        $data = [
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

        if($message) {
            // 検索結果が該当しない場合=messageが存在する場合true
            return view('places.review', [
                'places' => $places,
                'keywords' =>array_merge($request->input(), $request->session()->getOldInput()),
                'message' => $message,
            ]);
        } else {
            return view('places.review', [
                'places' => $places,
                'keywords' =>array_merge($request->input(), $request->session()->getOldInput()),
            ]);
        }
    }
    /*
    * review step1-2 場所選択を住所から探すcitiesの取得
     */
    public function searchAdd(Request $request)
    {
        // dd($request->key_id);
        if ($request->city != null) {
            $city = City::find($request->city);
            $places = $city->places()->paginate(5);

            return view('places.search_add', [
                'places' => $places,
            ]);
        }

        $cities = City::paginate(10);

        return view('places.search_add', [
            'cities' => $cities,
        ]);
    }
}
