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
		<div class="mb-2 bg-primary border-top mb-2 px-2">
			<ol class="breadcrumb my-0 px-0" style="overflow-y: auto;white-space: nowrap;display: -webkit-box;">
			{!! Html::decode(Breadcrumbs::render('tag', $tag)) !!}
			</ol>
		</div>
	</nav>
@endsection

@section('content')
<div class="container-fluid">
	<div class="col px-0">
		<div class="clearfix">
			<h2 class="mx-1 mt-2"><i class="fas fa-tags"></i> {{ $tag->name }}タグ付きスポット</h2>

			<button class="navbar-toggler float-right px-0 d-lg-none" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
				<span class="badge badge-info font-weight-normal">＋条件変更</span>
			</button>

		</div>

		@if (!empty($places))
		<div class="places-item">
			@include('commons.place_item', ['places' => $places])
		</div>
		@endif
	</div>
</div>
@endsection