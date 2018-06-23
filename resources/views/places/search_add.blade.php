@extends('layouts.app')

@section('title', '口コミ投稿')

@section('content')

	@include('commons.step_navi', [])

	@include('commons.search_tab', [])

	<div>
		@include('cities.search_city_list', ['cities' => $cities])
	</div>

@endsection