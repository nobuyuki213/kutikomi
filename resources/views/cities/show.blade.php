@extends('layouts.app')

@section('title', $city->name.'のスポット')

@section('content_f')

<div class="row">
	<div class="col px-2">
		<h2 class="mx-1 mt-2"><i class="fas fa-map-marker-alt"></i> {{ $city->name }}を探す</h2>
		<small class="mx-1">{{ $city->name_furi }}</small>

		@foreach ($places as $place)

			<div class="card mt-2">
				<div class="card-header clearfix">
					<h4 class="float-left mb-0">{{ $place->name }}</h4>
					<p class="float-right mb-0 pt-1">お気に入りアイコン</p>
				</div>
				<div class="card-body">

					<div class="media row">
						<a href="#" class="mr-3 col-sm-3">
							<img src="..." alt="メディアの画像">
						</a>
						<div class="media-body col-sm-9">
							<div>
								＜口コミ平均点＞＜口コミ件数＞
							</div>
							{{ $place->description }}
							<div>
								＜最新口コミ１件表示＞
							</div>
						</div><!-- /.media-body -->
					</div><!-- /.media -->

					<h5 class="card-title">Try Other</h5>
					<h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6>
					<p class="card-text"></p>
					<i class="fas fa-tags"{{--  style="color: #F3969A;" --}}></i>
					@foreach ($place->tags as $tag)
						<a href="#" class="badge badge-pill badge-info p-1 my-1">
							<h6 class="mb-0 px-1"># {{ $tag->name }}</h6>
						</a>
					@endforeach
				</div>
				<div class="card-footer">
					詳細ページリンク（ボタンor範囲指定扱い）
					{!! Html::decode(link_to_route('places.show', '<i class="fas fa-map-marker-alt"></i> <small>'.$place->name.'</small>', ['id' => $place->id])) !!}
				</div>
			</div>

		@endforeach

	</div>
</div>

@endsection