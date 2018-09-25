<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\City;
use App\Place;
use App\Tag;

class CitiesController extends Controller
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
        // $id で city を取得する
        $city = City::find($id);
        // city ページでの 検索絞り込みをするため place のクエリビルダクラスのインスタンスを作る
        $places_query = Place::query();
        // city に属する places を取得する
        $places = $places_query->where('city_id', $city->id);
        // $request に tagword が存在しているか確認->絞り込み条件
        if ($request->has('tagword')){
            // tag-name と　tgaword　が同じ条件に一致する tag に紐づく place のみを取得
            $places = $places_query->whereHas('tags', function ($query) use ($request) {
                $query->where('tags.name', $request->tagword);
            });
        }
        $places = $places_query->paginate(10);

        // 全ての city を取得-city-side用 キャッシュ版 ※以下のコードは、修正前のまま
        // $json_cities = Cache::remember('side_cities', 30, function(){
        //     $data = City::withCount('places')->get();
        //     return json_encode($data);
        // });
        // $cities = json_decode($json_cities);

        // $request に tagword が存在しているか確認->絞り込み条件
        if ($request->has('tagword')) {
            // tagword が存在していれば、tag.name と tagword が一致する tag に紐づく places が唯一属す city を取得 <city-side用>
            $cities = City::whereHas('places', function ($query) use ($request) {
                $query->whereHas('tags', function ($query) use ($request) {
                    $query->where('tags.name', $request->tagword);
                });
            // 合わせて count数も取得
            })->withCount(['places' => function ($query) use ($request) {
                $query->whereHas('tags', function ($query) use ($request) {
                    $query->where('tags.name', $request->tagword);
                });
            }])->get();

        } else {
            // tagword が存在しなければ、全ての city と count数を取得　<city-side用>
            $cities = City::withCount('places')->get();

        }

        // Cityに属するPlaseに、1つ以上存在するtagのみを取得-tag_side用
        $tags = Tag::whereHas('places', function ($query) use ($city) {
            $query->where('city_id', $city->id);
        })->take(5)->get();

        $data = [
            'city' => $city, 'places' => $places, 'cities' => $cities,
        ];

        // plaseに該当するtagが空でなければ、$dataに tags を追加
        if (!empty($tags)){
            $data += ['tags' => $tags];
            //$request に tagword が存在していれば、 $data に tagword と $tag を追加
            if (!empty($request->tagword)){
                $data += [
                    'tagword' => $request->tagword,
                    'tag' => $tags->where('name', $request->tagword)->first(),
                ];
            }
        }

        return view('cities.show', $data);
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
