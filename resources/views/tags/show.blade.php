@extends('layouts.app')

@section('title', $tag->name.'のタグ付きスポット')

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
			{!! Html::decode(Breadcrumbs::render('tag', $tag)) !!}
			</ol>
		</div>
	</nav>
@endsection

@section('content')
<div class="container-fluid">
	<div class="col px-0">
		<h2 class="mx-1 mt-2"><i class="fas fa-tags"></i> {{ $tag->name }}タグ付きスポット</h2>

		@if (!empty($places))
		<div class="places-item">
			@include('commons.place_item', ['places' => $places])
		</div>
		@endif
	</div>
</div>
@endsection