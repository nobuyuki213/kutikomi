<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //複数代入設定
    protected $fillable = ['name'];

    /**
     * リレーション定義
     */

    // tagに該当する複数のplacesを取得
    public function places()
    {
    	return $this->belongsToMany(place::class, 'place_tag', 'tag_id', 'place_id')->withTimestamps();
    }

    /**
     * 条件定義
     */

    //
    public function scopehasTags($query, $ids)
    {
    	// place の id と一致する place の tag を取得
    	return self::whereHas('places', function ($query) use ($ids) {
    		$query->whereIn('places.id', $ids);
    	});
    }

    // tag に対する重複を除いた palce を取得
    public function only_places($tag)
    {
        return Place::whereHas('tags', function ($query) use ($tag) {
            $query->where('tags.id', $tag->id);
        })->get();
    }
}
