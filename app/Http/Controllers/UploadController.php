<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class UploadController extends Controller
{
    //
    public function updateAvatar(Request $request)
    {
    	$disk = Storage::disk('public');
    	// ファイルのバリデーション
    	$this->validate($request, [
    		'avatar' => 'required|file|image',
    	]);
    	// ファイルの存在を確認する
    	if ($request->hasFile('avatar')){
    		// $request から file を受け取り $avatar 変数に代入
    		$avatar = $request->file('avatar');
    		// 画像のファイル名を時刻の数値に変換し、 $avatar->getClientOriginalExtension() で拡張子を取得
    		$filename = time() . '.' . $avatar->getClientOriginalExtension();
    		// 幅を200pxだけ指定し高さは自動処理でリサイズし、publicディレクトリの中のstoreage/avatarsディレクトリに '200-$filename' で画像を保存
    		Image::make($avatar)->resize(250, null, function($constraint){
    			$constraint->aspectRatio();
    		})->crop(200,200)->save(public_path('/storage/avatars/' . '200-' . $filename));

    		// ユーザーテーブルの avatar に保存した画像のファイル名を保存
    		$user = \Auth::user();
    		$user->avatar = '200-' . $filename;
    		$user->save();

    		$reviews = $user->reviews()->get();
    	}

    	return view('users.show', [
    		'user' => $user,
    		'reviews' => $reviews,
    	]);
    }
}
