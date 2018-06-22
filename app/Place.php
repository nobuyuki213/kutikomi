<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    //
    protected $fillable = [
    	'city_id', 'name', 'description',
    ];

    public function city()
    {
    	return $this->belongsTo(City::class);
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
