<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;
use App\Tag;

class SearchController extends Controller
{
    // search places view
    public function search(Request $request)
    {
    	$places = Place::search($request);
    	$message = $places['message'];
    	$places = $places['places'];
    	// dd($places);
    	// 検索で該当した places に紐づく 重複を除くtag を取得
    	$p_ids = $places->pluck('id');
    	$tags = Tag::hasTags($p_ids)->get(); // ローカルスコープ 記述先Tagモデル
    	// dd($tags);
    	if ($message) {
    		// 検索結果が該当しない場合＝messageが存在する場合 true
			return view('search', [
				'places' => $places,
				'keywords' => $request->keywords,
				'message' => $message,
			]);
    	} else {
    		return view('search', [
    			'places' => $places,
    			'keywords' => $request->keywords,
    			'tags' => $tags,
    			'tagword' => $request->tagword,
    		]);
    	}

    }
}
