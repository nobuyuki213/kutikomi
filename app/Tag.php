<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //複数代入設定
    protected $fillable = ['name'];

    // tagに該当する複数のplacesを取得
    public function places()
    {
    	return $this->belongsToMany(place::class, 'place_tag', 'tag_id', 'place_id')->withTimestamps();
    }
}
