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
	<div class="input-group mb-3 col-md-4 offset-md-4">
		<input type="text" class="form-control border-info" placeholder="廿日市市" aria-label="..." aria-describedby="button-addon2"　style="border: 2px;">
		<div class="input-group-append">
			<button type="button" id="button-addon2" class="btn btn-outline-info">
				<i class="fas fa-search fa-sm"> 検索</i>
			</button>
		</div>
	</div>
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