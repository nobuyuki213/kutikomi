@extends('layouts.app')

@section('title', '口コミ投稿')

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

</div>
@endsection