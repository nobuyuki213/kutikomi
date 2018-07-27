<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;
use App\Place;
use Illuminate\Validation\Rule;

class UploadController extends Controller
{
	//
	public function updateAvatar(Request $request)
	{
		$disk = Storage::disk('s3');
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
			// 画像のデータの幅を200pxだけ指定し高さは自動処理でリサイズする
			$contents = Image::make($avatar)->resize(250, null, function($constraint){
				$constraint->aspectRatio();
			})->crop(200,200)->encode();
			// AWS s3 の 指定のフォルダに保存する(※指定のフォルダが存在していなくても自動的に作成される)
			// ＊加工画像を AWS s3 に直接保存するには encode()メソッドと (string) による文字列型 の記述が必須
			$disk->put('storage/avatars/'.\Auth::user()->id.'/'.'200-'.$filename, (string) $contents, 'public');

			// ユーザーテーブルの avatar に保存した画像のファイル名を保存
			$user = \Auth::user();
			$user->avatar = '200-' . $filename;
			$user->save();
		}

		return redirect()->route('users.show', ['id' => \Auth::user()->id]);
	}

	// place photo upload function
	public function photo(Request $request, $data, $placeId)
	{
		$disk = Storage::disk('s3');
		// dd($data['good_review']);
		// $request　で受け取った　photo ファイルデータが存在し、かつ空でないかを確認
		if ($request->file('photo')->isvalid()) {
			// photo 画像データを保存するフォルダ分けで使うため $place_id 変数に代入 ※$request->place には place の id をリクエストに含ませていた
			if ($request->has['place']) {
				$place_id = $request->place;
			} else {
				$place_id = $placeId;
			}
			// $request にある photo = 画像データを $photo 変数に代入
			$photo = $request->file('photo');
			// 画像データの名前を被らないように「photo_・・・」にし、その拡張子を画像データから取得しファイル名を作る
			$filename = uniqid('photo_') . '.' . $photo->getClientOriginalExtension();

			// 最初に、サイズ加工しないままの画像を AWS s3 に保存し、リサイズ(幅400px高さは幅に合わせて自動設定)やクロップ(250px x 250px)を施した画像のファイル名の頭文字に「250x250-」を付けて画像を AWS s3 に直接保存する
			// ＊加工画像を AWS s3 に直接保存するには encode()メソッドと (string) による文字列型 の記述が必須
			$org_contents = Image::make($photo)->encode();
			$disk->put('storage/places/' . $place_id . '/' . $filename, (string) $org_contents, 'public');
			$thm_contents = Image::make($photo)
								->resize(400, null, function($constraint) { $constraint->aspectRatio(); })
								->crop(250,250)
								->encode();
			$disk->put('storage/places/' . $place_id . '/250x250-' . $filename, (string) $thm_contents, 'public');

			// 引数の $data に格納している $reviewインスタンス を使い、review と photo の紐付けを含めて画像のファイル名を photo テーブルに保存
			// サイズ加工していないのを「original」 サイズ加工を施したのを「thumbnail」とする
			// (補足)この機能実装時では、good_review を優先して photo の紐付けをしている
			if (!empty($data['good_review'])) {
				$data['good_review']->photos()->create(['original' => $filename, 'thumbnail' => '250x250-' . $filename,]);
			}
			if (!empty($data['bad_review'])) {
				$data['bad_review']->photos()->create(['original' => $filename, 'thumbnail' => '250x250-' . $filename,]);
			}
		}

	}

}
