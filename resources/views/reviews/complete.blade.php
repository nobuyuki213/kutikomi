@extends('layouts.app')

@section('title', '投稿完了')

@section('navbar')
	@include('commons.navbar')
@endsection

@section('content')
{{-- <pre>
	{{ print_r(Session::all()) }}
</pre> --}}
<div class="container">
	@include('commons.step_navi3', [])
</div>
<div class="jumbotron jumbotron-fluid">
	<div class="container text-center">
		<h1 class="display-1"><i class="far fa-handshake fa-3x"></i></h1>
		<h1 class="display-1">Thank you</h1>
	</div>
</div>
@if (session()->has('complete'))
	<div class="alert alert-success col-md-8 mx-auto text-center">
		{{ session('complete') }}
	</div>
@endif
@endsection