<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        //
        $city = City::find($id);
        $places = $city->places()->get();
        // 全ての city を取得-city-side用
        $cities = City::all();
        // Cityに属するPlaseに、1つ以上存在するtagのみを取得-tag_side用
        $tags = Tag::whereHas('places', function ($query) use ($city) {
            $query->where('city_id', $city->id);
        })->take(5)->get();
        // $request に tagword が存在しているか確認
        if ($request->has('tagword')){
            // tag-name の条件に一致する tag と紐づく place のみを取得
            $places = Place::whereHas('tags', function ($query) use ($request) {
                $query->where('tags.name', $request->tagword);
            })->get();
        }
        $data = [
            'city' => $city, 'places' => $places, 'cities' => $cities,
        ];
        // plaseに該当するtagが空でなければ、$dataに tags を追加
        if (!empty($tags)){
            $data += ['tags' => $tags];
            //$request に tagword が存在していれば、 $data に tagword を追加
            if (!empty($request->tagword)){
                $data += ['tagword' => $request->tagword];
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
