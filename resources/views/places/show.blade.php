@extends('layouts.app')

@section('title', $place->name.'の口コミ･評価')

@section('navbar')
	@include('commons.navbar')
@endsection

@section('breadcrumbs')
	<nav area-label="breadcrumbs-list">
		<div class="mb-2 bg-primary border-top">
			<ol class="breadcrumb container my-0">
			{!! Html::decode(Breadcrumbs::render('place', $place)) !!}
			</ol>
		</div>
	</nav>
@endsection

@section('content')

	@include('commons.place_show_header', ['place' => $place])

	@include('commons.place_show_navscroll', ['place' => $place])

<div class="container" id="container" style="height:1000px;">
	<div class="content row">
		<div class="content-main col-lg-8 px-2">
			{{-- ここから review --}}
			<div class="review card my-2">
				<div class="card-header text-center">
					<div class="">
						<div class="fa-5x text-secondary">
							<i class="far fa-comment fa-flip-horizontal"></i>
						</div>
						<div class="">
							<h3 class="d-inline-block">{{ $place->name }}の口コミ <span class="align-text-top badge badge-pill bg-white border border-secondary text-secondary">全 {{ $place->reviews->count() }}件</span></h3>
						</div>
					</div>
				</div>
				<div class="card-body">

					<div class="px-3 my-0">
					@forelse ($place->reviews_latest as $review)
						@if ($loop->index == 3)
							@break
						@endif
						<div class="row border-bottom py-2">
							<div class="balloon5 col-md-1 col-2 px-1">
								<div class="faceicon">
									★ここに画像を入れる <img~>★
								</div>
							</div>
							<div class="chatting card-text col-md-11 col-10 px-0">
								<div class="says border-secondary">
										<small id="c-show-kuti">{{ $review->comment }}</small>
								</div>
							</div>
							<div class="clearfix w-100">{{-- ＊＊＊＊＊＊このレビューが0の場合、投稿者名と点数を表示するかどうか要検討＊＊＊＊＊ --}}
								<div class="float-left">
									<small>{{ $review->user->name }}</small>
								</div>
								<div class="float-right">
									<small>
										@include('commons.static_rating', ['params' => empty($review->rating) ? 0 : $review->rating])
									</small>
									<h6 class="d-inline-block font-weight-bold text-secondary">
											{{ empty($review->rating) ? 0 : $review->rating }}
									</h6>
								</div>
							</div>
						</div>
					@empty
						<small>こちらはレビューがありません。</small>
					@endforelse
					</div>

					<div class="media mt-2 border-bottom">{{-- ＊＊＊＊＊上記のレビュー表示のスタイルとどちらのパターンで表示するか要検討＊＊＊＊＊ --}}
						<a href="#" class="mr-3">
							<img src="..." alt="顔アイコン">
						</a>
						<div class="media-body">
							<div class="" id="p-show-kuti">
								口コミ文がここに入る　口コミ文がここに入る　口コミ文がここに入る　口コミ文がここに入る　口コミ文がここに入る　口コミ文がここに入る　口コミ文がここに入る　口コミ文がここに入る　（途中表示を・・・にする）
							</div>
							<div>
								<P class="mt-0 text-right">＜この口コミの点＞</P>
							</div>
						</div><!-- /.media-body -->
					</div><!-- /.media -->
				</div>
				<div class="card-footer p-0">
					{!! link_to_route('place.reviews', '全ての口コミ（'.$place->reviews->count().'件）を見る', ['id' => $place->id], ['class' => 'btn btn-outline-primary btn-lg btn-block py-2 rounded-0']) !!}
				</div>
			</div>
			{{-- ここから photo --}}
			<div class="photo card my-2">
				<div class="card-header text-center">
					<div class="">
						<div class="fa-5x text-secondary">
							<i class="far fa-images"></i>
						</div>
						<h3>{{ $place->name }}のフォト <span class="badge badge-pill bg-light align-text-bottom text-secondary">27</span></h3>
					</div>
				</div>
				<div class="card-body">
					ここにフォト（フォトの配列方法、表示方法は要検討）
				</div>
				<div class="card-footer">
					全てのフォト（〇〇件）を見る（ボタンタイプ）
				</div>
			</div>
			{{-- ここから map --}}
			<div class="map card my-2">
				<div class="card-header text-center">
					<div class="">
						<div class="fa-5x text-secondary">
							<i class="fas fa-map-marked"></i>
						</div>
						<h3>{{ $place->name }}のマップ <span class="badge badge-pill bg-light align-text-bottom text-secondary">27</span></h3>
					</div>
				</div>
				<div class="card-body">
					ここにマップ（googleマップAPI活用予定）方法はまだ不明
				</div>
				<div class="card-footer">
					フッターの仕様用途未定
				</div>
			</div>
		</div>
		{{-- ここから sidecolumn --}}
		<div class="content-side col-lg-4 pl-lg-4 px-2">
			<div class="card my-2">
				<h5 class="card-header">ヘッダのタイトル</h5>
				<div class="card-body">
					コンテンツ
				</div>
				<div class="card-footer">フッタ</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('script')

	@include('commons.place_show_script')

@endsection