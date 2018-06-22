@extends('layouts.app')

@section('title', '口コミ投稿')

@section('content')

{{-- ステップナビ --}}
<div class="mt-4">
	<nav>
		<ol class="cd-breadcrumb cd-multi-steps text-bottom count">
			<li class="current">
				<em>場所選択</em>
			</li>
			<li>
				<em>レビューを書く</em>
			</li>
			<li>
				<em>ユーザー情報</em>
			</li>
		</ol>
	</nav>
</div>

<div>
	<h5>レビューする場所や施設を選ぶ</h5>
	<hr>
</div>

{{-- タブ部分 --}}
<nav>
	<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">

		<a class="nav-item nav-link active" id="nav-name-search-tab" data-toggle="tab" href="#nav-name-search" role="tab" aria-controls="nav-name-search" aria-selected="true"><small>名前<br>で探す</small></a>

		<a class="nav-item nav-link" id="nav-address-search-tab" data-toggle="tab" href="#nav-address-search" role="tab" aria-controls="nav-address-search" aria-selected="false"><small>住所<br>で探す</small></a>

	</div>
</nav>

{{-- パネル部分 --}}
<div class="tab-content mt-3" id="nav-tabContent">

	<div class="tab-pane fade show active" id="nav-name-search" role="tabpanel" aria-labelledby="nav-name-search-tab">
		<div>
			<h5 class="offset-sm-1">キーワードを入力</h5>
		</div>
		{!! Form::open(['route' => 'places.search', 'method' => 'get']) !!}
		<div class="form-group row mx-auto">
			{!! Form::text('keyword', empty($keyword) ? '' : $keyword, ['class' => 'form-control form-control-lg col-sm-8 my-1 ml-auto']) !!}
			{!! Form::button('<i class="fas fa-search fa-sm"> 検索</i>', ['class' => 'btn btn-secondary  btn-lg col-sm-2 my-1 mr-auto', 'type' => 'submit']) !!}
		</div>
		{!! Form::close()!!}
		<div>
			@if (empty($keyword) ? false : $places)
				@foreach ($places as $place)
					{{ $place->name }}
				@endforeach
			@else
				@if (empty($message) ? false : $message)
					<p class="offset-sm-1">{{ $message }}</p>
				@endif
			@endif
		</div>
	</div>


	<div class="tab-pane fade" id="nav-address-search" role="tabpanel" aria-labelledby="nav-address-search-tab">
		プロフィールの文章です。...
	</div>

</div>

@endsection