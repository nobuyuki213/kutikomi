<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Place extends Model
{
    //複数代入設定
    protected $fillable = [
    	'city_id', 'name', 'description',
    ];
    //placeに属するcityを取得
    public function city()
    {
    	return $this->belongsTo(City::class);
    }
    //placeに対する複数のtagsを取得
    public function tags()
    {
    	return $this->belongsToMany(Tag::class, 'place_tag', 'place_id', 'tag_id')->withTimestamps();
    }

    /**＜place検索機能実装＞
     * placesから複数単語検索
     */
    public function scopesearch($query, $request)
    {
        $places = self::query();
        $hasParam = true;
        $search_keywords;

        if(isset($request->keywords)) {
            // 検索キーワードを分割
            if(isset($request->keywords)) {
                // 全角スペースを半角スペースにする
                $request->keywords = mb_convert_kana($request->keywords, 's');
                // スペースごとに配列で格納する
                $strArry = preg_split("/[\s,]+/", $request->keywords);
                // collection::classで配列要素全てにワイルドカード(%)を追加
                $search_keywords = Collection::make($strArry)->map(function($q) {
                    return "%" . $q . "%";
                })->toArray();
            }
            $count = count($search_keywords);
            // name, description それぞれにwhere旬で検索
            $places = $places
                ->where(function($query)use($search_keywords) {
                    foreach ($search_keywords as $key => $search_keyword) {
                        $query->where('name', 'like', $search_keyword);
                    }
                })->orwhere(function($query)use($search_keywords) {
                    foreach ($search_keywords as $key => $search_keyword) {
                        $query->where('description', 'like', $search_keyword);
                    }
                })->paginate(5);
        } else {
            $hasParam = false;
            $places = $places;
        }
        // それぞれの値をひとまとめにする配列を準備する
        $data = [];
        // 初期表示にメッセージができないようにする
        if($places->count() <= 0 && $hasParam) {
            $data['message'] = $request->keywords . "に該当する場所はありませんでした。";
        } else {
            $data['message'] = "";
        }
        $data['places'] = $places;

        return $data;
    }
}
