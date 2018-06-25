{{-- 閲覧履歴ページ --}}
@extends('layouts.app')

@section('title', '閲覧履歴')

@section('content')

<div class="mt-5">

	<pre>
		{{ print_r($s_places) }}
	</pre>
	<pre>
		{{ print_r(session()->getId()) }}
	</pre>

	{{ session('url') }}

	{!! Form::open(['route' => 'session.post']) !!}
	<div class="form-group">
		{!! Form::label('keyword', '入力')!!}
		{!! Form::text('keyword', '', ['class' => 'form-control'])!!}
	</div>
	{!! Form::submit('send', ['class' => 'btn btn-success']) !!}
	{!! Form::close() !!}

</div>

<div>
	<p>閲覧履歴変数の場合の表示スタイル</p>
	@foreach ($s_places['places'] as $s_place)
		{{ $s_place->id }}<br>
		{{ $s_place->name }}<br>
		{{ $s_place->description }}<br>
		{{ $s_place->created_at }}<br>
	@endforeach
	<p>閲覧履歴session保存の表示スタイル</p>
	{{ session('places.0')->id }}<br>
	{{ session('places.0')->name }}<br>
	{{ session('places.0')->description }}<br>
	{{ session('places.0')->created_at }}<br>
</div>

@endsection