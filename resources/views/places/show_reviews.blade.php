@extends('layouts.app')

@section('title', $place->name.'の口コミ・評価一覧')

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

<div class="container"　id="container" style="height:1000px;">
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

				@foreach ($reviews as $review)
				{{-- {{dd($review)}} --}}
					<div class="mx-0 mb-4">
						<div class="card">
							<h5 class="card-header bg-transparent">
								<div class="media">
									<a href="#" class="mr-3">
										<img src="..." alt="メディアの画像">
									</a>
									<div class="media-body">
										<span class="my-auto" style="font-size:0.8rem;">{{ $review->user->name}}</span>
									</div><!-- /.media-body -->
								</div><!-- /.media -->
							</h5>
							<div class="card-body">
								<img class="card-img" src="..." alt="カードの画像">
							</div>
							<div class="card-footer">
								<div class="review-header">
									<span class="fa-lg align-text-bottom">
										{!! ($review->pivot->type == 'good') ? '<i class="far fa-laugh text-secondary"></i>' : '<i class="far fa-frown text-success"></i>' !!}
									</span>
									<span class="small">
										@include('commons.static_rating', ['params' => empty($review->rating) ? 0 : $review->rating])
									</span>
									<h6 class="d-inline-block font-weight-bold text-secondary mb-0">
											{{ empty($review->rating) ? 0 : $review->rating }}
									</h6>
								</div>
								<div class="review-comment">
									<div class="review-lead border-bottom py-2">
										{{ $review->comment }}
									</div>
								</div>
								<div class="revire-footer pt-2">
									<span class="small float-right">
										created_at: {{ $review->creationTimes() }}
									</span>
								</div>
							</div>
						</div>
					</div>
				@endforeach

				</div>
				<div class="card-footer">
					footer
				</div>
			</div>
		</div>
		<div class="content-side col-lg-4 pl-lg-4 px-2">
			
		</div>
	</div>
</div>

@endsection

@section('script')

	@include('commons.place_show_script')

@endsection