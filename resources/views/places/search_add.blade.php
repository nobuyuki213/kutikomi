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
		@include('cities.search_city_list', ['cities' => $cities])
	</div>

</div>
@endsection