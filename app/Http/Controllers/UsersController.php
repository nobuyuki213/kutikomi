<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        // ログイン済みかの確認
        if (\Auth::check()){
            // ログイン中のユーザーから情報を取得する
            $user = \Auth::user();
            // user のお気に入りしたスポットを新しい順で取得
            $json_favorites = Cache::remember('favorites', 30, function(){
                $data = \Auth::user()->favorite_desc()->get();
                return json_encode($data);
            });
            $favorites = json_decode($json_favorites);

            // ユーザーの reviews を新しい順に並び替えて取得
            $json_reviews = Cache::remember('u_reviews', 30, function(){
                $data = \Auth::user()->reviews()->with(['user', 'places', 'photos'])->orderBy('created_at', 'desc')->get();
                return json_encode($data);
            });
            $reviews = json_decode($json_reviews);
            // draft reviews の並び順を　session に新しく保存した順にするため、collectヘルパと reverseメソッドを使い逆順にする
            $draft_reviews = collect($request->session()->get('draft'))->reverse();
            // pagination の設定
            $perPage = 10; //1ページに表示するレコード数
            $d_reviews = $this->custom_paginate($draft_reviews, $perPage);

            return view('users.show', [
                'user' => $user,
                'favorites' => $favorites,
                'reviews' => $reviews,
                'd_reviews' => $d_reviews,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // ニックネーム の更新
        if (\Auth::check()) {
            // nickname のバリデーション
            $this->validate($request, [
                'nickname' => 'required|string|min:6|max:20|alpha_dash',
            ]);

            $user = User::find($id);
            // $request の中にある新しいニックネームをセットし save で保存
            $user->nickname = $request->nickname;
            $user->save();

            return redirect()->route('users.show', ['id' => $user->id]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
