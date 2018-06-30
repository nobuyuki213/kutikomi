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
		{!! Form::text('keywords', empty($keywords['keywords']) ? old('keywords') : $keywords['keywords'], ['class' => 'form-control form-control-lg offset-sm-1 col-sm-8 ml-auto my-1']) !!}
		{!! Form::button('<i class="fas fa-search fa-sm"></i> 検索', ['class' => 'btn btn-secondary  btn-lg col-sm-2 mr-auto m-1', 'type' => 'submit']) !!}
	</div>
	{!! Form::close()!!}
	@if (isset($keywords['keywords']))
		@if (isset($message))
		<div class="bg-secondary offset-sm-1 col-sm-10 px-0" style="border: 0.3rem solid #F3969A;">
			<div class="card border-secondary">
				<div class="card-header">{{ $message }}</div>
			</div>
		</div>
		@else
		<div>
			@include('places.search_place_list', ['places' => $places])
		</div>
		@endif
	@endif
</div>
@endsection