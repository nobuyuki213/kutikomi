@extends('layouts.app')

@section('title', $tag->name.'のタグ付きスポット')

@section('stylesheet')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin-style.css')}}">
@endsection

@section('navbar')
	@include('commons.admin_navbar')
@endsection

@section('breadcrumbs')
	<nav area-label="breadcrumbs-list">
		<div class="mb-2 bg-primary border-top">
			<ol class="breadcrumb my-0">
			{!! Html::decode(Breadcrumbs::render('tag', $tag)) !!}
			</ol>
		</div>
	</nav>
@endsection

@section('content')
<div class="container-fluid">
	<div class="col px-2">
		<h2 class="mx-1 mt-2"><i class="fas fa-tags"></i> {{ $tag->name }}タグ付きスポット</h2>

		@if (!empty($places))
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
						<i class="fas fa-tags"></i>
						@foreach ($place->tags as $tag)
							<a href="{!! route('tags.show', ['tag' => $tag]) !!}" class="badge badge-pill badge-info p-1 my-1">
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
		@endif
	</div>
</div>
@endsection