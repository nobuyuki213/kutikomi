@extends('layouts.app')

@section('title', 'スポットを探す')

@section('stylesheet')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin-style.css')}}">
@endsection

@section('navbar')
	@include('commons.admin_navbar')
@endsection

@section('breadcrumbs')
	<nav area-label="breadcrumbs-list">
		<div class="bg-primary border-top mb-2 px-2">
			<ol class="breadcrumb my-0 px-0" style="overflow-y: auto;white-space: nowrap;display: -webkit-box;">
			{!! Html::decode(Breadcrumbs::render('search', $keywords, !empty($tagword) ? $tagword : '')) !!}
			</ol>
		</div>
	</nav>
@endsection

@section('content')
{{-- <pre>
	{{ var_dump(Request::all()) }}
</pre> --}}
<div class="container-fluid">
	<div class="col px-0">
		<div class="card">
			<div class="card-body p-2 p-md-3 clearfix">
				<span class="badge badge-pill badge-secondary my-1 align-top"><i class="fas fa-search"></i></span>
				<h5 class="d-inline mx-1 mt-2 align-bottom">"{{ $keywords }}"</h5>
				@if (!isset($message))
					<button class="navbar-toggler float-right px-0 d-lg-none" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
					aria-expanded="false" aria-label="Toggle navigation">
						<span class="badge badge-info font-weight-normal">＋条件変更</span>
					</button>
				@endif

			</div>
		</div>
		@if (isset($keywords))
			@if (isset($message))
			<div class="bg-secondary offset-sm-1 col-sm-10 px-0 mb-3" style="border: 0.3rem solid #F3969A;">
				<div class="card border-secondary mb-0">
					<div class="card-header">{{ $message }}</div>
				</div>
			</div>
			<div class="main-search-frame offset-sm-1 col-sm-10 px-0 d-lg-none">

				@include('commons.main_search_frame')

			</div>
			@else
			<div class="places-item">
				@include('commons.place_item', ['places' => $places])
			</div>
			@endif
		@endif
	</div>
</div>
@endsection