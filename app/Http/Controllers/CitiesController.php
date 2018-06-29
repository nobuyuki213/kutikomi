<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
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
    public function show($id)
    {
        //
        $city = City::find($id);
        $places = $city->places()->get();
        // Cityに属するPlaseに、1つ以上存在するtagのみを取得-tag_side用
        $tags = Tag::whereHas('places', function ($query) use ($city) {
            $query->where('city_id', $city->id);
        })->take(5)->get();
        $date = [
            'city' => $city,
            'places' => $places,
        ];
        // plaseに該当するtagが空でなければ、dataに追加
        if (!empty($tags)){
            $date += ['tags' => $tags];
        }

        return view('cities.show', $date);
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
