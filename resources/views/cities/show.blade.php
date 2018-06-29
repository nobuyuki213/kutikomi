@extends('layouts.app')

@section('title', $city->name.'のスポット')

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
			{!! Html::decode(Breadcrumbs::render('city', $city)) !!}
			</ol>
		</div>
	</nav>
@endsection

@section('content')
<div class="container-fluid">
	<div class="col px-2">
		<h2 class="mx-1 mt-2"><i class="fas fa-map-marker-alt"></i> {{ $city->name }}を探す</h2>
		<small class="mx-1">{{ $city->name_furi }}</small>

		@if (!empty($places))
			@foreach ($places as $place)

				<div class="card mt-2">
					<div class="card-header clearfix">
						<p class="float-right mb-0 pt-1"><i class="far fa-star fa-2x"></i></p>
						<h4 class="mb-0"><span class="align-middle">{{ $place->name }}</span></h4>
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