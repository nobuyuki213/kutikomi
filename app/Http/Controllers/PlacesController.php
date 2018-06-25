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

    /*
    * review step1-1　場所選択を名前検索で探す値の取得の実行
     */
    public function search()
    {
        // リクエストから検索のキーワードを取得
        $keyword = request()->keyword;

        // 空検索や初期アクセス時の場合は、ビューに遷移
        if ($keyword == null){
            $user_id = request()->session()->getId(); //＜＝＝＝＝テスト用
            return view('places.review', ['user_id' => $user_id]); //＜＝＝＝＝テスト用

        /*検索キーワードがあれば、placeモデルから該当する値を取得
        *※placesSearchはクエリスコープ使用
        */
        } else {
            $places = '';
            $places = Place::PlaceSearch($keyword)->paginate(10);

            // 検索キーワードに該当し配列として取得できた場合の処理
            if ($places->isNotEmpty()){
                $user_id = request()->session()->getId(); //＜＝＝＝＝テスト用
                return view('places.review', [
                    'keyword' => $keyword,
                    'places' => $places,
                    'user_id' => $user_id, //＜＝＝＝＝テスト用
                ]);

            // 検索キーワードに該当しなかった場合の処理
            } else {
                $message = '※該当する場所がありませんでした';
                $user_id = request()->session()->getId(); //＜＝＝＝＝テスト用
                return view('places.review', [
                    'keyword' => $keyword,
                    'message' => $message,
                    'user_id' => $user_id, //＜＝＝＝＝テスト用
                ]);
            }
        }
    }

    /*
    * review step1-2 場所選択を住所から探す値の取得の実行
     */
    public function searchAdd()
    {
        $cities = City::paginate(10);

        return view('places.search_add', [
            'cities' => $cities,
        ]);
    }
}
