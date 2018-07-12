<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //　1つのソーシャルアカウントに属するユーザを取得
    public function accounts()
    {
        return $this->hasMany(SocialAccount::class);
    }
    //　User に該当する複数の review を取得
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    // User に該当する複数の pLces を取得
    public function places()
    {
        return $this->belongsToMany(Place::class, 'place_user', 'user_id', 'place_id')
                    ->withPivot('type')
                    ->withTimestamps();
    }
    // User のお気に入りに該当する複数の place を取得
    public function favorite_places()
    {
        return $this->places()->where('type', 'favorite');
    }
    /*
    * User がお気に入り実行処理
     */
    public function favorite($placeId)
    {
        // 既にお気に入りしているか確認する
        $exist = $this->is_favorite($placeId);
        if ($exist){
            // 既にお気に入りしていれば、何もしない
            return false;
        }
        else {
            // まだお気に入りしていなければ　お気に入りする
            $this->places()->attach($placeId, ['type' => 'favorite']);
            return true;
        }
    }
    /*
    * User がお気に入り解除処理
     */
    public function unfavorite($placeId)
    {
        // 既にお気に入りしているか確認する
        $exist = $this->is_favorite($placeId);
        if ($exist){
            // 既にお気に入りしていれば、お気に入りを解除する
            $this->places()->detach($placeId, ['type' => 'favorite']);
            return true;
        }
        else {
            return false;
        }
    }
    /*
    * User がお気に入りしているか確認する処理
     */
    public function is_favorite($placeId)
    {
        return $this->favorite_places()->where('place_id', $placeId)->exists();
    }

    /**
     * user に属する review と rating の保存と
     * review と place の関係性(place_review中間テーブル)を type good で保存
     * $data 変数で review インスタンスを返す
     */
    public function toReview($request, $placeId)
    {
        // $request に good_comment が存在し、かつ空でないかを確認
        if ($request->filled('good_comment')) {
            // user に紐づく review の rating と good_comment の値を作成して保存
            $good_review = $this->reviews()->create([
                'rating' => $request->good_rating,
                'comment' => $request->good_comment,
            ]);
            // 作成した review に紐づく place の関係性と type を good で保存
            $good_review->places()->attach($placeId, ['type' => 'good']);
            // $request に bad_comment が存在し、かつ空でないかを確認
            if ($request->filled('bad_comment')) {
                //user に紐づく review の rating と bad_comment の値を作成して保存
                $bad_review = $this->reviews()->create([
                    'rating' => $request->bad_rating,
                    'comment' => $request->bad_comment,
                ]);
                // 作成した review に紐づく palce の関係性と type を bad で保存
                $bad_review->places()->attach($placeId, ['type' => 'bad']);
            }
            // review と一緒に photo をアップロードした場合 review に属する photo で保存するできる reviewインスタンスを返すために $data に配列にする(＊1)
            $data = [
                'good_review' => $good_review,
            ];
            return $data;
        } else {
            //  $request に good_comment が存在していない、または空だったら bad_comment が存在し、かつ空でないかを確認
            if ($request->filled('bad_comment')) {
                //user に紐づく review の rating と bad_comment の値を作成して保存
                $bad_review = $this->reviews()->create([
                    'rating' => $request->bad_rating,
                    'comment' => $request->bad_comment,
                ]);
                // 作成した review に紐づく place の関係性と type を bad で保存
                $bad_review->places()->attach($placeId, ['type' => 'bad']);
                // (＊1)と同様の説明
                $data = [
                    'bad_review' => $bad_review,
                ];
                return $data;
            }
            return false;
        }
    }
}
