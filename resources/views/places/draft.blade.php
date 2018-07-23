@extends('layouts.app')

@section('title', 'レビューの場所を下書きから探す')

@section('stylesheet')

@endsection

@section('navbar')
	@include('commons.navbar')
@endsection

@section('content')
<div class="container">

	@include('commons.step_navi1', [])

	@include('commons.search_tab', [])

	@if ($d_reviews->count() > 0)
		<div class="draft-reviews bg-secondary" style="border: 0.3rem solid #F3969A;">
			@include('commons.draft_reviews' , ['d_reviews' => $d_reviews])
		</div>
	@else
		<div class="alert alert-info text-center">
			レビューの下書きはありません
		</div>
	@endif

	<nav class="pagination-lg mx-auto mt-3" style="width: 180px;">
		{{ $d_reviews->render("pagination::simple-bootstrap-4") }}
	</nav>

</div>
@endsection

@section('script')

@endsection
