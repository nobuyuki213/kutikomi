<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //複数代入の設定
    protected $fillable = [
    	'name', 'name_furi',
    ];
    //Cityに該当する複数のplaceを取得
    public function places()
    {
    	return $this->hasMany(Place::class);
    }
    // ローカルスコープの定義
    /*
    *あ行だけに限定するクエリスコープ
     */
    public function scopeLineA($query)
    {
    	return $query->where(function($q){
    		$q->where('name_furi', 'like', 'あ%')
    		->orwhere('name_furi', 'like', 'い%')
    		->orwhere('name_furi', 'like', 'う%')
    		->orwhere('name_furi', 'like', 'え%')
    		->orwhere('name_furi', 'like', 'お%');
    	});
    }

    /*
    *か行だけに限定するクエリスコープ
     */
    public function scopeLineKa($query)
    {
    	return $query->where(function($q){
    		$q->where('name_furi', 'like', 'か%')
    		->orwhere('name_furi', 'like', 'き%')
    		->orwhere('name_furi', 'like', 'く%')
    		->orwhere('name_furi', 'like', 'け%')
    		->orwhere('name_furi', 'like', 'こ%');
    	});
    }

    /*
    *さ行だけに限定するクエリスコープ
     */
    public function scopeLineSa($query)
    {
    	return $query->where(function($q){
    		$q->where('name_furi', 'like', 'さ%')
    		->orwhere('name_furi', 'like', 'し%')
    		->orwhere('name_furi', 'like', 'す%')
    		->orwhere('name_furi', 'like', 'せ%')
    		->orwhere('name_furi', 'like', 'そ%');
    	});
    }

    /*
    *た行だけに限定するクエリスコープ
     */
    public function scopeLineTa($query)
    {
    	return $query->where(function($q){
    		$q->where('name_furi', 'like', 'た%')
    		->orwhere('name_furi', 'like', 'ち%')
    		->orwhere('name_furi', 'like', 'つ%')
    		->orwhere('name_furi', 'like', 'て%')
    		->orwhere('name_furi', 'like', 'と%');
    	});
    }

    /*
    *な行だけに限定するクエリスコープ
     */
    public function scopeLineNa($query)
    {
    	return $query->where(function($q){
    		$q->where('name_furi', 'like', 'な%')
    		->orwhere('name_furi', 'like', 'に%')
    		->orwhere('name_furi', 'like', 'ぬ%')
    		->orwhere('name_furi', 'like', 'ね%')
    		->orwhere('name_furi', 'like', 'の%');
    	});
    }

    /*
    *は行だけに限定するクエリスコープ
     */
    public function scopeLineHa($query)
    {
    	return $query->where(function($q){
    		$q->where('name_furi', 'like', 'は%')
    		->orwhere('name_furi', 'like', 'ひ%')
    		->orwhere('name_furi', 'like', 'ふ%')
    		->orwhere('name_furi', 'like', 'へ%')
    		->orwhere('name_furi', 'like', 'ほ%');
    	});
    }

    /*
    *ま行だけに限定するクエリスコープ
     */
    public function scopeLineMa($query)
    {
    	return $query->where(function($q){
    		$q->where('name_furi', 'like', 'ま%')
    		->orwhere('name_furi', 'like', 'み%')
    		->orwhere('name_furi', 'like', 'む%')
    		->orwhere('name_furi', 'like', 'め%')
    		->orwhere('name_furi', 'like', 'も%');
    	});
    }

    /*
    *や行だけに限定するクエリスコープ
     */
    public function scopeLineYa($query)
    {
    	return $query->where(function($q){
    		$q->where('name_furi', 'like', 'や%')
    		->orwhere('name_furi', 'like', 'ゆ%')
    		->orwhere('name_furi', 'like', 'よ%');
    	});
    }

    /*
    *ら行だけに限定するクエリスコープ
     */
    public function scopeLineRa($query)
    {
    	return $query->where(function($q){
    		$q->where('name_furi', 'like', 'ら%')
    		->orwhere('name_furi', 'like', 'り%')
    		->orwhere('name_furi', 'like', 'る%')
    		->orwhere('name_furi', 'like', 'れ%')
    		->orwhere('name_furi', 'like', 'ろ%');
    	});
    }

    /*
    *わ行だけに限定するクエリスコープ
     */
    public function scopeLineWa($query)
    {
    	return $query->where(function($q){
    		$q->where('name_furi', 'like', 'わ%');
    	});
    }
}
