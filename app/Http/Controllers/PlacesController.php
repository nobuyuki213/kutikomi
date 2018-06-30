<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;
use App\City;
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

        $data = [
            'place' => $place,
            'city' => $city,
        ];
        //sessionテスト用
        //sessinoにキー名placesが存在するか確認
        $is_places = $request->session()->has('places');

        Session::put('places', [$place]);//値を保存
        // Session::push('places', $place);//値を追加
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
        if ($request->key_id != null) {
            $city = City::find($request->key_id);
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
