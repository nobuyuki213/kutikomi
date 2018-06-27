<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

        // ローカルスコープの定義
    /*
    *placeから検索するクエリスコープ
     */
    public function scopePlaceSearch($query, $keyword)
    {
    	return $query->where('name', 'like', '%'.$keyword.'%')
    		->orwhere('description', 'like', '%'.$keyword.'%');
    }
}
