<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;
use App\City;

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
    public function show($id)
    {
        //
        $place = Place::find($id);
        $city = $place->city()->get();

        $data = [
            'place' => $place,
            'city' => $city,
        ];

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
    * place review search page show
     */
    public function search()
    {
        $keyword = request()->keyword;

        if ($keyword == null){
            return view('places.review');

        } else {
            $places = '';
            $places = Place::PlaceSearch($keyword)->paginate(10);

            if ($places->isNotEmpty()){

                return view('places.review', [
                    'keyword' => $keyword,
                    'places' => $places,
                ]);

            } else {
                $message = '※該当する場所がありませんでした';

                return view('places.review', [
                    'keyword' => $keyword,
                    'message' => $message,
                ]);
            }
        }
    }

    public function searchAdd()
    {
        $cities = City::paginate(10);

        return view('places.search_add', [
            'cities' => $cities,
        ]);
    }
}
