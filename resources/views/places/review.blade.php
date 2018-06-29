@extends('layouts.app')

@section('title', '口コミ投稿')

@section('navbar')
	@include('commons.navbar')
@endsection

@section('content')
<div class="container">

	@include('commons.step_navi', [])

	@include('commons.search_tab', [])

	<div>
		<h5 class="offset-sm-1">キーワードを入力</h5>
	</div>
	{!! Form::open(['route' => 'places.review', 'method' => 'get']) !!}
	<div class="form-group row mx-auto">
		{!! Form::text('keyword', empty($keyword) ? old('keyword') : $keyword, ['class' => 'form-control form-control-lg offset-sm-1 col-sm-8 ml-auto my-1']) !!}
		{!! Form::button('<i class="fas fa-search fa-sm"></i> 検索', ['class' => 'btn btn-secondary  btn-lg col-sm-2 mr-auto m-1', 'type' => 'submit']) !!}
	</div>
	{!! Form::close()!!}
	<div>
		@if (empty($keyword) ? false : true)
			@if (empty($message) ? false : true)
				<p class="offset-sm-1">{{ $message }}</p>
			@else
				@include('places.search_place_list', ['places' => $places])
			@endif
		@endif
	</div>

</div>
@endsection