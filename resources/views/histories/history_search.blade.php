@extends('layouts.app')

@section('title', '検索履歴')

@section('stylesheet')

@endsection

@section('navbar')
	@include('commons.navbar')
@endsection

@section('breadcrumbs')
	<nav area-label="breadcrumbs-list">
		<div class="bg-primary border-top mb-2 px-2">
			<ol class="breadcrumb container my-0 px-0" style="overflow-y: auto;white-space: nowrap;display: -webkit-box;">
			{!! Html::decode(Breadcrumbs::render('history.search')) !!}
			</ol>
		</div>
	</nav>
@endsection

@section('content')
<div class="container">
	<div class="card mt-3 border-0">
		<div class="card-header text-center">
			<div class="">
				<div class="fa-5x text-primary">
					<i class="fas fa-history"></i>
				</div>
				<div class="">
					<h3>検索履歴</h3>
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
			<div class="history-searches">
				@if (!empty($s_searchwords))
					@foreach ($s_searchwords as $s_search)
					<div class="history-search card mb-3">
						<div class="card-body p-3">
							<a href="{!! $s_search['url'] !!}" style="text-decoration:none">
								<p class="history-time small text-muted">search time: {{ $s_search['history_at'] }}</p>
								<h5 class="font-weight-bold mb-0"><i class="fas fa-search small"></i> "{{ $s_search['search'] }}"</h5>
							</a>
						</div>
					</div>
					@endforeach
				@else
					<div class="alert alert-info text-center">
						スポットの検索履歴はまだありません
					</div>
					<div class="main-search-frame">

						@include('commons.main_search_frame')

					</div>
				@endif
			</div>
		</div>
	</div>
	@if (!empty($_searchwords))
		<div class="pagination">
			{{ $s_searchwords->render("pagination::simple-bootstrap-4") }}
		</div>
	@endif
</div>
@endsection

@section('script')

@endsection