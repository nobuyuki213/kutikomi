@extends('layouts.app')

@section('title', 'タグ一覧')

@section('navbar')
	@include('commons.navbar')
@endsection

@section('breadcrumbs')
	<nav area-label="breadcrumbs-list">
		<div class="bg-primary border-top mb-2 px-2">
			<ol class="breadcrumb container my-0 px-0" style="overflow-y: auto;white-space: nowrap;display: -webkit-box;">
			{!! Html::decode(Breadcrumbs::render('tags')) !!}
			</ol>
		</div>
	</nav>
@endsection

@section('content')
<div class="container">
	<div class="pt-3">
		<header id="header" class="">
			<div class="py-lg-4 py-2">
				<h2 class="text-center text-secondary"><i class="fas fa-tags"></i> タグ一覧</h2>
			</div>
		</header><!-- /header -->
		<div class="card">
			<div class="card-body px-2">
			@foreach ($tags as $tag)
				<a href="{!! route('tags.show', ['tag' => $tag]) !!}" class="badge badge-pill badge-info p-2 m-1">
					<h6 class="mb-0"># {{ $tag->name }} <span class="badge badge-pill badge-light align-top">{{ empty($tag->places) ? '0' : $tag->only_places($tag)->count() }}</span></h6>
				</a>
			@endforeach
			</div>
			{{-- <div class="card-footer">フッタ</div> --}}
		</div>
	</div>
</div>
@endsection