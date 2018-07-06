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
    /**
     * user に属する review と rating の保存と
     * review と place の関係性(place_review中間テーブル)を type good で保存
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
            return true;
        } else {
            //  $request に good_comment が存在していない、または空だったら bad_comment が存在し、かつ空でないかを確認
            if ($request->filled('bad_comment')) {
                //user に紐づく review の rating と bad_comment の値を作成して保存
                $bad_comment = $this->reviews()->create([
                    'rating' => $request->bad_rating,
                    'comment' => $request->bad_comment,
                ]);
                // 作成した review に紐づく place の関係性と type を bad で保存
                $bad_comment->places()->attach($placeId, ['type' => 'bad']);

                return true;
            }
            return false;
        }
    }
}
