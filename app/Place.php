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
    /**
     * リレーション定義
     */
    // place に該当する複数の user 達を取得
    public function users()
    {
        return $this->belongsToMany(User::class, 'place_user', 'place_id', 'user_id')
                    ->withPivot('type')
                    ->withTimestamps();
    }
    // placeに属するcityを取得
    public function city()
    {
    	return $this->belongsTo(City::class);
    }
    // placeに対する複数のtagsを取得
    public function tags()
    {
    	return $this->belongsToMany(Tag::class, 'place_tag', 'place_id', 'tag_id')->withTimestamps();
    }
    // place に対する複数の review と 中間テーブルの type を合わせて取得
    public function reviews()
    {
        return $this->belongsToMany(Review::class)->withPivot('type')->withTimestamps();
    }

    /**
     * 加工定義
     */

    // place に対してタイプが good の review　のみを取得
    public function good_reviews()
    {
        return $this->reviews()->where('type', 'good');
    }
    // place に対してタイプが bad の review　のみを取得
    public function bad_reviews()
    {
        return $this->reviews()->where('type', 'bad');
    }
    // place に対する 作成日が最新の review を取得
    public function reviews_latest()
    {
        return $this->reviews()->latest('reviews.created_at');
    }
    // place に対する null を除く rating の平均値を取得
    public function reviews_rating_avg()
    {
        return $this->reviews()->whereNotNull('rating')->avg('rating');
    }
    // place に対する reviews の中で photo が存在している review を取得
    public function reviews_with_photos()
    {
        return $this->reviews()
                    ->whereExists(function ($q) {
                    $q->from('photos')
                      ->whereRaw('photos.review_id = reviews.id');
                  })->get();
    }

    /**＜place検索機能実装＞
     * placesから複数単語検索
     */
    public function scopesearch($query, $request)
    {
        $places_query = self::query();
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
            $places = $places_query->where(function($query)use($search_keywords){

                $query->where(function($query)use($search_keywords) {
                    foreach ($search_keywords as $key => $search_keyword) {
                        $query->where('name', 'like', $search_keyword);
                    }
                })->orwhere(function($query)use($search_keywords) {
                    foreach ($search_keywords as $key => $search_keyword) {
                        $query->where('description', 'like', $search_keyword);
                    }
                });

            });
            if ($request->has('tagword')) {
                $places = $places_query->whereHas('tags', function($query) use ($request) {
                    $query->where('tags.name', $request->tagword);
                });
            }

            $places = $places_query->paginate(5);
        } else {
            $hasParam = false;
            $places = $places_query;
        }
        // それぞれの値をひとまとめにする配列を準備する
        $data = [];
        // 初期表示にメッセージができないようにする
        if($places->count() <= 0 && $hasParam) {
            $data['message'] = '"'.$request->keywords.'"' . "に該当する場所はありませんでした。";
        } else {
            $data['message'] = "";
        }
        $data['places'] = $places;

        return $data;
    }
}
