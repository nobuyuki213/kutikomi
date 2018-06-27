@extends('layouts.app')

@section('title', 'タグ一覧')

@section('content')
<div class="pt-5">
	<nav>
		パンくずリスト設置(ライブラリの利用)
	</nav>
	<header id="header" class="">
		<div class="py-lg-4 py-2">
			<h2 class="text-center text-secondary"><i class="fas fa-tags"></i> タグ一覧</h2>
		</div>
	</header><!-- /header -->
	<div class="card">
		<div class="card-body px-2">
		@foreach ($tags as $tag)
			<a href="#" class="badge badge-pill badge-info p-2 m-1">
				<h6 class="mb-0"># {{ $tag->name }} <span class="badge badge-pill badge-light align-top">{{ $tag->places()->count() }}</span></h6>
			</a>
		@endforeach
		</div>
		<div class="card-footer">フッタ</div>
	</div>
</div>
@endsection