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
    	return $this->belongsToMany(Tag::class, 'place_tag', 'tag_id', 'place_id')->withTimestamps();
    }
    //ローカル氏コープの定義
    /*
    * 1つ以上タグ付けされたタグを取得
     */
    public function scopeTagged($query)
    {
    	return $query->where('tag_id', '>', 1)->distinct();
    }
}
