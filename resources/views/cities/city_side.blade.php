@if (Request::is('search'))
<div class="card bg-white">
	<p class="card-header align-middle">
		<i class="fas fa-map-marker-alt"></i> {{ $keywords == "" ? 'エリアから探す' : 'エリアで絞り込む' }}
	</p>
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
				@if ($keywords != "")
					{!! Form::open(['route' => 'search', 'method' => 'get', 'name' => "form_city{$key}"]) !!}
					<div class="form-group mb-0">
						{!! Form::hidden('keywords', empty($keywords) ? old('keywords') : $keywords) !!}
						<input name="cityId" type="hidden" value="{{ $city->id }}">
						@if (!empty($tagword)) <input name="tagword" type="hidden" value="{{ $tagword }}"> @endif
						<a href="javascript:form_city{{$key}}.submit()" class="list-group-item list-group-item-action border-0">
							{{ $city->name }}
							<span class="badge badge-primary badge-pill font-weight-normal float-right">{{ $city->places_count }}</span>
						</a>
					</div>
					{!! Form::close() !!}
				@else
					<a href="{{ route('cities.show', ['id' => $city->id]) }}" class="list-group-item list-group-item-action py-2 border-0">
						{{ $city->name }}
						<span class="badge badge-primary badge-pill font-weight-normal float-right">{{ $city->places_count }}</span>
					</a>
				@endif
			@endforeach
			</div>
		</div>
	</div>
</div>
@endif

@if (Request::is('hirosima/cities/*'))
<div class="card bg-white">
	<p class="card-header align-middle">
		<i class="fas fa-map-marker-alt"></i> 他のエリアを見る
	</p>
	<div class="card-body p-2">
		@if (!empty($city))
		<div class="select-city card">
			<div class="card-body p-2">
				<span>選択エリア：</span>
				@if (!empty($tag))
					<a href="{!! route('tags.show', $tag->id) !!}" style="text-decoration:none">
						<h6 class="d-inline-block mb-0 px-1">{{ $city->name }}</h6><i class="far fa-times-circle"></i>
					</a>
				@else
					<h6 class="d-inline-block mb-0 px-1">{{ $city->name }}</h6>
				@endif
			</div>
		</div>
		@endif
		<div class="city-items">
			<div class="list-group list-group-flush">
			@foreach ($cities as $city_item)
				<div class="city-item" style="position:relative">
					{!! link_to_route('cities.show', $city_item->name, !empty($tagword) ? ['id' => $city_item->id, 'tagword' => $tagword] : ['id' => $city_item->id], ['class' => ($city->id == $city_item->id) ? 'py-3 list-group-item list-group-item-action active' : 'text-muted border-0 py-2 list-group-item list-group-item-action']) !!}
					<span class="badge badge-primary badge-pill font-weight-normal" style="position:absolute;top:35%;right:0.5rem;z-index:5;">{{ $city_item->places_count }}</span>
				</div>
			@endforeach
			</div>
		</div>
	</div>
</div>
@endif

@if (Request::is('*tags/*'))
<div class="card bg-white">
	<p class="card-header align-middle">
		<i class="fas fa-map-marker-alt"></i> エリアで絞り込む
	</p>
	<div class="card-body py-2 pl-2 pr-lg-0 pr-2">
		<div class="city-items">
			<div class="list-group list-group-flush">
			@foreach ($cities as $city_item)
				<div class="city-item" style="position:relative">
					{!! link_to_route('cities.show', $city_item->name, ['id' => $city_item->id, 'tagword' => $tagword], ['class' => 'text-muted border-0 py-2 list-group-item list-group-item-action']) !!}
					<span class="badge badge-primary badge-pill font-weight-normal" style="position:absolute;top:35%;right:0.5rem;z-index:5;">{{ $city_item->places_count }}</span>
				</div>
			@endforeach
			</div>
		</div>
	</div>
</div>
@endif