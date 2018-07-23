@extends('layouts.app')

@section('title', 'レビューの場所を名前で探す')

@section('stylesheet')
	{{-- validationEngine.CSS --}}
	<link rel="stylesheet" href="{{ asset('js/jQuery-Validation-Engine-master/css/validationEngine.jquery.css') }}">
@endsection

@section('navbar')
	@include('commons.navbar')
@endsection

@section('content')
<div class="container">

	@include('commons.step_navi1', [])

	@include('commons.search_tab', [])

	<div>
		<h5 class="offset-sm-1">キーワードを入力</h5>
	</div>
	{!! Form::open(['route' => 'places.review', 'method' => 'get']) !!}
	<div class="form-group row mx-auto">
		{!! Form::text('keywords', empty($keywords['keywords']) ? old('keywords') : $keywords['keywords'], ['class' => 'form-control form-control-lg offset-sm-1 col-sm-8 ml-auto mb-sm-0 mb-2']) !!}
		{!! Form::button('<i class="fas fa-search"></i>', ['class' => 'btn btn-lg btn-secondary col-sm-2 mr-auto ml-sm-1', 'type' => 'submit']) !!}
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
	<div class="new-place-form my-2">

		@include('commons.new_place_form')

	</div>

</div>
@endsection

@section('script')
	{{-- validationEngine.jquery --}}
	<script src="{{ asset('js/jQuery-Validation-Engine-master/js/jquery-1.8.2.min.js') }}"></script>
	<script src="{{ asset('js/jQuery-Validation-Engine-master/js/jquery.validationEngine.js') }}"></script>
	<script src="{{ asset('js/jQuery-Validation-Engine-master/js/languages/jquery.validationEngine-ja.js') }}"></script>
	<script>
		$(function(){
			jQuery("#form_new_place").validationEngine('attach', {
				promptPosition: "inline"
			});
		});
	</script>
@endsection