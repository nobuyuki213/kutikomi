<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    // 複数代入設定
    protected $fillable = [
    	'place_id', 'original', 'thumbnail',
    ];
    /**
     * リレーション定義
     */
    // photo が所属する reviwe を取得
    public function place()
    {
    	return $this->belongsTo(Review::class);
    }
}