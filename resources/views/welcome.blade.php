@extends('layouts.app')

@section('title', 'welcome')

@section('stylesheet')
	{{-- slider-pro CSS--}}
	<link rel="stylesheet" href="{{ asset('css/slider-pro.min.css') }}"/>
@endsection

@section('navbar')
	@include('commons.navbar')
@endsection

@section('cover')
	<div class="cover">
		<div class="cover-inner">
			<div class="cover-contents col-sm-12">
				<h1 class="display-4">探そう</h1>
			</div>
		</div>
	</div>
	<div class="main-search-frame col-lg-6 offset-lg-3 col-md-8 offset-md-2">

		@include('commons.main_search_frame')

	</div>
@endsection

@section('content')
@if ($reviews->count() >= 3)
<div class="container">
	<div class="new-reviews-pickup my-4 col-lg-8 mx-auto px-0">

		<div class="slider-pro" id="slidertop">
			<div class="sp-slides">
				@foreach ($reviews as $review)
				<div class="sp-slide">
					<div class="sp-layer" data-width="100%">
						<div class="card">
							<div class="card-body">
								<div class="row px-3">
									<div class="balloon5 col-md-1 col-2 px-1">
										<div class="faceicon">
											<img src="{{ asset('storage/avatars/' . $review->user->avatar) }}" class="img-fluid" alt="user-icon">
										</div>
									</div>
									<div class="chatting card-text col-md-11 col-10 px-0">
										<div class="says border-secondary">
											<small id="c-show-kuti">{{ $review->comment }}</small>
										</div>
									</div>
									<div class="clearfix w-100">
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
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>

	</div>
</div>
@endif
<div class="container">
	@if(Session::has('message'))
	  メッセージ：{{ session('message') }}
	@endif

	<div class="card">
		<div class="card-header">住所から探す</div>
		@if (count($cities) > 0)
			<?php $key = 0; ?>
			@foreach ($cities as $cities)
				@if ($cities->isNotEmpty())
					<div class="card-body">
						<h6 class="card-text">{{ $lines[$key].' 行' }}</h6>
					</div>
					<ul class="list-inline row mx-1 mb-0">
						@foreach ($cities as $city)
							<li class="list-inline-item col-lg-3 col-6 mr-0 py-2 px-3">
								{!! Html::decode(link_to_route('cities.show', '<i class="fas fa-map-marker-alt"></i> <small>'.$city->name.'</small>', ['id' => $city->id])) !!}
								<small class="d-block" style="font-size: 0.5rem;">{{ $city->name_furi }}</small>
								<p class="d-block mb-0" style="font-size: 0.5rem;">{{ $city->places()->count().' 件' }}</p>
							</li>
						@endforeach
					</ul>
				@endif
			<?php $key++; ?>
			@endforeach
		@endif
	</div>
	<div>
		@include('tags.tag_full', ['tags' => $tags])
	</div>
</div>
@endsection

@section('script')

	<script src="{{ asset('js/jquery.sliderPro.min.js') }}"></script>
	<script>
		$( document ).ready(function( $ ) {
			$('#slidertop').sliderPro({
				width: 600,
				centerImage: true,
				autoHeight: true,
				visibleSize: "100%",
				slideDistance: 10,
				buttons: false,
				autoplayDelay: 8000,
				breakpoints: {
					480: {
						width: "100%",
						autoHeight: true,
						visibleSize: "auto",
						slideDistance: 10,
						autoplayDelay: 8000,
					}
				}
			});
		});
	</script>

@endsection