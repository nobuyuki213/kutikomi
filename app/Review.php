<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Review extends Model
{
    // 複数代入設定
    protected $fillable = [
    	'user_id', 'comment', 'rating',
    ];
    // review が所属する user を取得
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    // review に対する複数の place と合わせて type を取得
    public function places()
    {
    	return $this->belongsToMany(Place::class)->withPivot('type')->withTimestamps();
    }
    // review のタイプが good のみの複数の place を取得
    public function good_places()
    {
    	return $this->places()->where('type', 'good');
    }
    // review のタイプが bad のみの複数の place を取得
    public function bad_places()
    {
    	return $this->places()->where('type', 'bad');
    }

    /**
     * review の投稿日からの経過日時を取得
     * 60秒以内なら「秒前」、60分以内なら「分前」、24時間以内なら「時間前」
     * 1週間以内なら「日前」、1ヶ月以内なら「週前」、一ヶ月以上で今年なら「月、日」去年なら「年、月、日」で経過日時により表示を変更
     */
    public function creationTimes()
    {
    	$now = Carbon::now();
    	$c_at = Carbon::parse($this->created_at);
    	$diff_sec = $now->diffInSeconds($c_at);

    	if ($diff_sec < 60) {
	    	return $c_at->diffInSeconds($now).'秒前';
    	}
    	elseif ($diff_sec < 3600) {
    		return $c_at->diffInMinutes($now).'分前';
    	}
    	elseif ($diff_sec < 86400) {
    		return $c_at->diffInHours($now).'時間前';
    	}
    	elseif ($diff_sec < 604800) {
    		return $c_at->diffInDays($now).'日前';
    	}
    	elseif ($diff_sec < 2764800) {
    		return $c_at->diffInWeeks($now).'週前';
    	}
    	else {
    		if ($now->year == $c_at->year) {
				return $c_at->format('Y年m月d日');
    		}
    		else {
    			return $c_at->format('m月d日');
    		}
    	}
    }
}
