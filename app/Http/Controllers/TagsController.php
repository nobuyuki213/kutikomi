<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\City;
use App\Place;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //全てtagを取得
        $tags = Tag::all();
        $data = [
            'tags' => $tags,
        ];
        return view('tags.index', $data);
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
        $tag = Tag::find($id);
        $places = $tag->only_places($tag);
        // 1つ以上Plaseに存在するtagのみを取得-tag_side用
        $tags = Tag::has('places')->get();
        // $tag->name と一致する places数と、全ての ciry を取得 <city-side用>
        $cities = City::withCount(['places' => function ($query) use ($tag) {
            $query->whereHas('tags', function ($query) use ($tag) {
                $query->where('name', $tag->name);
            });
        }])->get();

        $data = [
            'tag' => $tag,
            'tagword' => $tag->name,
            'places' => $places,
            'cities' => $cities,
        ];
        $data += ['tags' => $tags,];
        return view('tags.show', $data);
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
