<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;
use App\Tag;
use Session;

class SearchController extends Controller
{
	// search places view
	public function search(Request $request)
	{
		$places = Place::search($request);
		$message = $places['message'];
		$places = $places['places'];
		// 検索で該当した places に紐づく 重複を除くtag を取得
		$p_ids = $places->pluck('id');
		$tags = Tag::hasTags($p_ids)->get(); // ローカルスコープ 記述先Tagモデル

		// $message が空かを確認をする => $message が空でなければ　session に検索ワードを保存しない
		if (empty($message)) {
			$keywords = $request->keywords;
			// searchwords のが空でなくかつ null でないか確認する
			if ($request->session()->has('searchwords')) {
				// 既に存在していれば、searchwords.{$keywords} をのキーに該当する連想配列を削除する
				$request->session()->forget("searchwords.{$keywords}");
				// 改めて、保存する(※viewで一覧表示する時の並び順の関係で、削除して保存する動作を組んでいる)
				$request->session()->put("searchwords.{$keywords}", [
					'search' => $keywords,
					'history_at' => now()->format('Y-m-d H:i:s'),
					'url' => $request->fullurl(),
				]);
			} else {
				// まだ存在していなければ、保存のみする
				$request->session()->put("searchwords.{$keywords}", [
					'search' => $keywords,
					'history_at' => now()->format('Y-m-d H:i:s'),
					'url' => $request->fullurl(),
				]);
			}
		}

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
