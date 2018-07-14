@extends('layouts.app')

@section('title', 'welcome')

@section('navbar')
	@include('commons.navbar')
@endsection

@section('cover')
	<div class="cover">
		<div class="cover-inner">
			<div class="cover-contents col-sm-12">
				<h1 class="display-4">サービスを探そう</h1>
			</div>
		</div>
	</div>
	<!--検索フォームここから　修正必要 最終的にコメント消去-->
	{!!  Form::open(['route' => 'search', 'method' => 'get']) !!}
	<div class="form-group">
		<div class="input-group mb-3 col-lg-6 offset-lg-3 col-md-8 offset-md-2">
			{!! Form::text('keywords', empty($keywords['keywords']) ? old('keywords') : $keywords['keywords'], ['class' => 'form-control border border-info py-3', 'placeholder' => '施設名など', 'aria-describedby' => "button-addon2"]) !!}
			<div class="input-group-append">
				{!! Form::button('<i class="fas fa-search fa-lg"></i>', ['class' => 'btn btn-info px-lg-5 px-md-4 px-3', 'id' => 'button-addon2', 'type' => 'submit']) !!}
			</div>
		</div>
	</div>
	{!! Form::close() !!}
	<!--検索フォームここまで　修正必要-->
@endsection

@section('content')
<div class="container">
	@if(Session::has('message'))
	  メッセージ：{{ session('message') }}
	@endif

	<div class="card">
		<div class="card-header">住所から探す</div>
		@if (count($cities) > 0)
			<?php $key = 0; ?>
			@foreach ($cities as $cities)
				@if ($cities->isNotEmpty())
					<div class="card-body">
						<h6 class="card-text">{{ $lines[$key].' 行' }}</h6>
					</div>
					<ul class="list-inline row mx-1 mb-0">
						@foreach ($cities as $city)
							<li class="list-inline-item col-lg-3 col-6 mr-0 py-2 px-3">
								{!! Html::decode(link_to_route('cities.show', '<i class="fas fa-map-marker-alt"></i> <small>'.$city->name.'</small>', ['id' => $city->id])) !!}
								<small class="d-block" style="font-size: 0.5rem;">{{ $city->name_furi }}</small>
								<p class="d-block mb-0" style="font-size: 0.5rem;">{{ $city->places()->count().' 件' }}</p>
							</li>
						@endforeach
					</ul>
				@endif
			<?php $key++; ?>
			@endforeach
		@endif
	</div>
	<div>
		@include('tags.tag_full', ['tags' => $tags])
	</div>
</div>
@endsection