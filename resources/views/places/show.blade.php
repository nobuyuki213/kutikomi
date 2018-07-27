@extends('layouts.app')

@section('title', $place->name.'の口コミ･評価')

@section('stylesheet')
	{{-- slider-pro CSS--}}
	<link rel="stylesheet" href="{{ asset('css/slider-pro.min.css') }}"/>
@endsection

@section('navbar')
	@include('commons.navbar')
@endsection

@section('breadcrumbs')
	<nav area-label="breadcrumbs-list">
		<div class="bg-primary border-top mb-2 px-2">
			<ol class="breadcrumb container my-0 px-0" style="overflow-y: auto;white-space: nowrap;display: -webkit-box;">
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
				<div class="review-pickup card-body">

					<div class="px-3 my-0">
					@forelse ($place->reviews_latest as $review)
						@if ($loop->index == 3)
							@break
						@endif
						<div class="row border-bottom py-2">
							<div class="balloon5 col-md-1 col-2 px-1">
								<div class="faceicon">
								@if (Storage::disk('s3')->exists('storage/avatars/'.$review->user->id.'/'. $review->user->avatar))
									<img src="{{ asset(Storage::disk('s3')->url('storage/avatars/'. $review->user->id.'/'. $review->user->avatar)) }}" class="img-fluid" alt="user-icon">
								@else
									<img src="{{ asset(Storage::disk('s3')->url('storage/avatars/'. $review->user->avatar)) }}" class="img-fluid" alt="user-icon">
								@endif
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
						<div class="col"><small>こちらはレビューがありません。</small></div>
					@endforelse
					</div>

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
							<i class="fas fa-camera-retro"></i>
						</div>
						<h3>{{ $place->name }}のフォト <span class="align-text-top badge badge-pill bg-white border border-secondary text-secondary">{{ $place->reviews_with_photos()->count() }}枚</span></h3>
					</div>
				</div>
				<div class="card-body p-0">

					@if ($place->reviews_with_photos()->isNotEmpty())
					<div class="slider-pro" id="slider2">
						<div class="sp-slides">
							@foreach ($reviews_with_photos as $review)
							@if ($loop->index == 3) @break @endif
							<div class="sp-slide">
								@foreach ($review->photos as $photo)
								@if ($loop->index == 1) @break @endif
									<img class="sp-image" src="{{ asset(Storage::disk('s3')->url('storage/places/'.$place->id.'/'.$photo->original )) }}">
								@endforeach
							</div>
							@endforeach
						</div>
						@if ($place->reviews_with_photos()->count() >= 3)
						<div class="sp-thumbnails">
							@foreach ($reviews_with_photos as $review)
							@if ($loop->index == 3) @break @endif
							<div class="sp-thumbnail">
								@foreach ($review->photos as $photo)
								@if ($loop->index == 1) @break @endif
									<img class="sp-image" src="{{ asset(Storage::disk('s3')->url('storage/places/'.$place->id.'/'.$photo->thumbnail )) }}">
								@endforeach
							</div>
							@endforeach
						</div>
						@endif
					</div>
					@else
					<div class="not-image text-center">
						<i class="far fa-image fa-7x"></i>
						<h5>Not Photo</h5>
					</div>
					@endif

				</div>
				<div class="card-footer p-0">
					{!! link_to_route('place.photos', '全てのフォト（'.$place->reviews_with_photos()->count().'件）を見る', ['id' => $place->id], ['class' => 'btn btn-outline-primary btn-lg btn-block py-2 rounded-0']) !!}
				</div>
			</div>
			{{-- ここから map --}}
			<div class="map card my-2">
				<div class="card-header text-center">
					<div class="">
						<div class="fa-5x text-secondary">
							<i class="fas fa-map-marked-alt"></i>
						</div>
						<h3>{{ $place->name }}のマップ</h3>
					</div>
				</div>
				<div class="card-body p-0">
					<div id="plece_map">
						<iframe src="https://www.google.co.jp/maps?q={{$place->name}}&output=embed&t=m&z=16&hl=ja" width="750" height="750" frameborder="0" style="border:0" allowfullscreen></iframe>
					</div>
				</div>
				<div class="card-footer p-0">
					{!! link_to_route('place.map', '大きいマップを見る', ['id' => $place->id], ['class' => 'btn btn-outline-primary btn-lg btn-block py-2 rounded-0']) !!}
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
	{{-- slider-pro --}}
	<script src="{{ asset('js/jquery.sliderPro.min.js') }}"></script>
	<script>
		$( document ).ready(function( $ ) {
			$('#slider2').sliderPro({
				width:743,
				buttons: false,
				shuffle: true,
				// arrows: true,
				// fullScreen: true,
				thumbnailWidth: 250,
				thumbnailHeight: 60,
				slideDistance:0,
				breakpoints: {
					480: {
						thumbnailWidth: 135,
						thumbnailHeigit: 40
					}
				}
			});
		});
	</script>
	{{-- Google map script --}}
{{-- 	<script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP$key=AIzaSyCq28QA6ACwpnfoffb-46EPIrjI2NHqK-Y&callback=iniMap" async defer></script>
	<script>
		function iniMap() {
			'use strict';

			var plece_map = document.getElementById('plece_map');
			var map;
			var tokyo = {lat: 35.681167. lng:139.767052}
		}
	</script> --}}
@endsection