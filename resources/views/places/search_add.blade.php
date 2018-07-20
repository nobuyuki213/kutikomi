@extends('layouts.app')

@section('title', 'レビューの場所を住所で探す')

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

	@if (isset($places))
		<div>
			@include('places.search_place_list', ['places' => $places])
		</div>
	@elseif (isset($cities))
		<div>
			@include('cities.search_city_list', ['cities' => $cities])
		</div>
	@else
		該当ありません。これが表示される場合は不備がありますので原因を調べてください。
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