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
		<div class="mb-2 bg-primary border-top">
			<ol class="breadcrumb my-0">
			{!! Html::decode(Breadcrumbs::render('search', $keywords, !empty($tagword) ? $tagword : '')) !!}
			</ol>
		</div>
	</nav>
@endsection

@section('content')
<div class="container-fluid">
	<div class="col px-0">
		<div class="card">
			<div class="card-body p-2 p-md-3">
				<span class="badge badge-pill badge-secondary my-2 align-top"><i class="fas fa-search"></i></span>
				<h4 class="d-inline mx-1 mt-2 align-bottom">"{{ $keywords }}"</h4>
			</div>
		</div>
		@if (isset($keywords))
			@if (isset($message))
			<div class="bg-secondary offset-sm-1 col-sm-10 px-0" style="border: 0.3rem solid #F3969A;">
				<div class="card border-secondary mb-0">
					<div class="card-header">{{ $message }}</div>
				</div>
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