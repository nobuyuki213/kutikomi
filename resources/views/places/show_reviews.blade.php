@extends('layouts.app')

@section('title', $place->name.'の口コミ・評価一覧')

@section('stylesheet')
	{{-- PhotoSwipe Core CSS --}}
	<link rel="stylesheet" href="{{ asset('js/PhotoSwipe-master/dist/photoswipe.css') }}">
	{{-- PhotoSwipe Skin CSS --}}
	<link rel="stylesheet" href="{{ asset('js/PhotoSwipe-master/dist/default-skin/default-skin.css') }}">
@endsection

@section('navbar')
	@include('commons.navbar')
@endsection

@section('breadcrumbs')
	<nav area-label="breadcrumbs-list">
		<div class="mb-2 bg-primary border-top">
			<ol class="breadcrumb container my-0">
			{!! Html::decode(Breadcrumbs::render('review', $place)) !!}
			</ol>
		</div>
	</nav>
@endsection

@section('content')

	@include('commons.place_show_header', ['place' => $place])

	@include('commons.place_show_navscroll', ['place' => $place])

<div class="container" id="container" style="height:1000px;">
	<div class="contant row">
		<div class="content-main col-lg-8 px-2">
			<div class="review card my-2 border-0">
				<div class="card-header text-center h-100 py-0 bg-transparent">
					<div class="">
						<div class="fa-7x text-secondary">
							<i class="far fa-comment fa-flip-horizontal"></i>
							<h3 class="d-inline-block align-middle mb-4"><span class="badge badge-pill bg-white border border-secondary text-secondary">全 {{ $place->reviews->count() }}件</span></h3>
						</div>
					</div>
				</div>
				<div class="reviews-main card-body px-0">

					@include('reviews.reviews', ['place' => $place, 'reviews' => $reviews])

				</div>
				<div class="card-footer">
					footer
				</div>
			</div>
		</div>
		<div class="content-side col-lg-4 pl-lg-4 px-2">
			{{--未定--}}
		</div>
	</div>
</div>

@endsection

@section('script')

	@include('commons.place_show_script')

	{{-- PhotoSwipe Core javascript --}}
	<script src="{{ asset('js/PhotoSwipe-master/dist/photoswipe.min.js') }}"></script>
	{{-- PhotoSwipe UI javascript --}}
	<script src="{{ asset('js/PhotoSwipe-master/dist/photoswipe-ui-default.min.js') }}"></script>
	{{-- PhotoSwipe (追加外部ファイル) --}}
	<script src="{{ asset('js/PhotoSwipe-master/dist/photoswipe-sub.js') }}"></script>
@endsection