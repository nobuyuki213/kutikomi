@extends('layouts.app')

@section('title', $place->name.'の口コミ・評価フォト')

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
		<div class="bg-primary border-top mb-2 px-2">
			<ol class="breadcrumb container my-0 px-0" style="overflow-y: auto;white-space: nowrap;display: -webkit-box;">
			{!! Html::decode(Breadcrumbs::render('photo', $place)) !!}
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
			<div class="photo card my-2 border-0">
				<div class="card-header text-center h-100 py-0 bg-transparent">
					<div class="">
						<div class="fa-7x text-secondary">
							<i class="fas fa-camera-retro"></i>
							<h3 class="d-inline-block align-middle mb-4"><span class="badge badge-pill bg-white border border-secondary text-secondary">全 {{ $reviews_with_photos->count() }}枚</span></h3>
						</div>
					</div>
				</div>
				<div class="photos-main card-body">

					<div class="place-gallery row">
					@foreach ($reviews_with_photos as $review)
						@foreach ($review->photos as $photo)

							<figure class="figure col-4 mb-0 px-0 border">
								<a href="{{ asset(Storage::disk('s3')->url('storage/places/'.$place->id.'/'.$photo->original)) }}" data-size="1000x666">
									<img class="img-fluid" src="{{ asset(Storage::disk('s3')->url('storage/places/'.$place->id.'/'.$photo->thumbnail)) }}" alt="{{ $place->name.'-photo' }}">
								</a>
								<figcaption style="display: none;">{{ $place->name.'-photo' }}</figcaption>
							</figure>

						@endforeach
					@endforeach
					</div>

					@include('commons.photoswipe')

				</div>
				<div class="card-footer">
					footer
				</div>
			</div>
		</div>
		<div class="content-side col-lg-4 pl-lg-4 px-2">
			{{-- 未定 --}}
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