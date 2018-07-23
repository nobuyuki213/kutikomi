@extends('layouts.app')

@section('title', '閲覧履歴')

@section('stylesheet')

@endsection

@section('navbar')
	@include('commons.navbar')
@endsection

@section('breadcrumbs')
	<nav area-label="breadcrumbs-list">
		<div class="mb-2 bg-primary border-top">
			<ol class="breadcrumb container my-0">
			{!! Html::decode(Breadcrumbs::render('history_place')) !!}
			</ol>
		</div>
	</nav>
@endsection

@section('content')
@php
use App\Place;
@endphp
<div class="container">
	<div class="card mt-3 border-0">
		<div class="card-header text-center">
			<div class="">
				<div class="fa-5x text-primary">
					<i class="fas fa-history"></i>
				</div>
				<div class="">
					<h3>閲覧履歴</h3>
				</div>
			</div>
		</div>
		<div class="card-body px-0">
			<ul class="nav nav-pills justify-content-center mb-3">
				<li class="nav-item">
					<a href="{{ route('history.places') }}" class="{{ Request::is('recent/history') ? 'nav-link active' : 'nav-link' }}">
						最近見たスポット
						@if (!empty(Session::get('places')))
							<span class="badge badge-pill badge-dark font-weight-normal ml-2">{{ count(Session::get('places')) }}</span>
						@endif
					</a>
				</li>
				<li class="nav-item">
					<a href="{{ route('history.search') }}" class="{{ Request::is('recent/search') ? 'nav-link active' : 'nav-link' }}">
						検索ワード
						@if (!empty(Session::get('searchwords')))
							<span class="badge badge-pill badge-dark font-weight-normal ml-2">{{ count(Session::get('searchwords')) }}</span>
						@endif
					</a>
				</li>
			</ul>
			<div class="history-places">
				@if (!empty($s_places))
					@foreach ($s_places as $s_place)
					@php
						$place = Place::find($s_place['id']);
					@endphp
					<div class="history-place card mb-3">
						<div class="card-body clearfix p-3">
							<a href="{{ route('places.show', ['id' => $place->id]) }}" style="text-decoration:none">
								<p class="history-time float-md-right mb-2 small text-muted">最終アクセス: {{ $s_place['history_at'] }}</p>
								<h5 class="card-title text-muted">{{ $place->name }}</h5>
								<div class="places-status">
									<small>
										@include('commons.static_rating', ['params' => $place->reviews_rating_avg()])
									</small>
									<h6 class="d-inline-block font-weight-bold text-secondary">
										{{ sprintf('%.2f',$place->reviews_rating_avg()) }}
									</h6>
									<h6 class="d-inline-block font-weight-bold pl-2 text-muted">
										<i class="far fa-comment-dots fa-flip-horizontal fa-lg"></i> <span class=" text-secondary">{{ $place->reviews->count() }}</span> 件
									</h6>
									<p class="d-inline-block pl-2 mb-0 text-muted"><i class="fas fa-map-marker-alt"></i> {{ $place->city->name }}</p>
								</div>
							</a>
						</div>
					</div>
					@endforeach
				@else
					<div class="alert alert-info text-center">
						スポットの閲覧履歴はまだありません
					</div>
					<div class="main-search-frame">

						@include('commons.main_search_frame')

					</div>
				@endif
			</div>
		</div>
	</div>
	@if (!empty($s_places))
		<div class="pagination">
			{{ $s_places->render("pagination::simple-bootstrap-4") }}
		</div>
	@endif
{{-- 	<pre>
		{{  var_dump(Request::cookie('laravel_session')) }}
	</pre>
	<hr>
	<pre>
		{{  var_dump(Session::getId()) }}
	</pre>
	<hr>
	<pre>
		{{  var_dump(Session::all()) }}
	</pre> --}}
</div>
@endsection

@section('script')

@endsection