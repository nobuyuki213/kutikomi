@if (Request::is('search'))
<div class="card bg-white">
	<p class="card-header align-middle">エリアで絞り込む</p>
	<div class=" card-body p-2">
		@if (!empty($city))
		<div class="select-city card">
			<div class="card-body p-2">
				<span>選択エリア：</span>
				<a href="{!! empty($tagword) ? url('search/?keywords='.$keywords) : url('search/?keywords='.$keywords.'&tagword='.$tagword) !!}" style="text-decoration:none">
					<h6 class="d-inline-block mb-0 px-1">{{ $city->name }}</h6><i class="far fa-times-circle"></i>
				</a>
			</div>
		</div>
		@endif
		<div class="city-items">
			<div class="list-group list-group-flush">
			@foreach ($cities as $key => $city)
				{!! Form::open(['route' => 'search', 'method' => 'get', 'name' => "form_city{$key}"]) !!}
				<div class="form-group mb-0">
					{!! Form::hidden('keywords', empty($keywords) ? old('keywords') : $keywords) !!}
					<input name="cityId" type="hidden" value="{{ $city->id }}">
					@if (!empty($tagword)) <input name="tagword" type="hidden" value="{{ $tagword }}"> @endif
					<a href="javascript:form_city{{$key}}.submit()" class="list-group-item list-group-item-action text-muted border-0">
						{{ $city->name }}
					</a>
				</div>
				{!! Form::close() !!}
			@endforeach
			</div>
		</div>
	</div>
</div>
@endif

@if (Request::is('hirosima/cities/*'))
<div class="card bg-white">
	<p class="card-header align-middle">他のエリアを見る</p>
	<div class="card-body py-2 pl-2 pr-lg-0 pr-2">
		<div class="city-items">
			<div class="list-group list-group-flush">
			@foreach ($cities as $city_item)
				<div class="city-item" style="position:relative">
					{!! link_to_route('cities.show', $city_item->name, ['id' => $city_item->id], ['class' => ($city->id == $city_item->id) ? 'py-3 list-group-item list-group-item-action active' : 'text-muted border-0 py-2 list-group-item list-group-item-action']) !!}
					<span class=" badge badge-primary badge-pill font-weight-normal" style="position:absolute;top:35%;right:0.5rem;z-index:5;">{{ $city_item->places->count() }}</span>
				</div>
			@endforeach
			</div>
		</div>
	</div>
</div>
@endif

@if (Request::is('tags/*'))
<div class="card bg-white">
	<p class="card-header align-middle">他のエリアを見る</p>
	<div class="card-body py-2 pl-2 pr-lg-0 pr-2">
		<div class="city-items">
			<div class="list-group list-group-flush">
			@foreach ($cities as $city_item)
				<div class="city-item" style="position:relative">
					{!! link_to_route('cities.show', $city_item->name, ['id' => $city_item->id], ['class' => 'text-muted border-0 py-2 list-group-item list-group-item-action']) !!}
					<span class=" badge badge-primary badge-pill font-weight-normal" style="position:absolute;top:35%;right:0.5rem;z-index:5;">{{ $city_item->places->count() }}</span>
				</div>
			@endforeach
			</div>
		</div>
	</div>
</div>
@endif