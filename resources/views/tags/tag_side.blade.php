@if (Request::is('search'))
<div class="card bg-white">
	<P class="card-header align-middle">
		<i class="fas fa-tags"></i> {{ $keywords == "" ? 'タグから探す' : 'タグで絞り込む'}}
	</P>
	<div class="card-body p-2">
		@if (!empty($tagword))
		<div class="select-tag card">
			<div class="card-body p-2">
				<span>選択タグ：</span>
				<a href="{!! empty($city) ? url('search/?keywords='.$keywords) : url('search/?keywords='.$keywords.'&cityId='.$city->id) !!}" style="text-decoration:none">
					<h6 class="d-inline mb-0 px-1"># {{ $tagword }}</h6><i class="far fa-times-circle"></i>
				</a>
			</div>
		</div>
		@endif
		<div class="tag-items">
		@foreach ($tags as $key => $tag)
			@if ($keywords != "")
				{!! Form::open(['route' => 'search', 'method' => 'get', 'name' => "form_tag{$key}", 'class' => 'd-inline']) !!}
				<div class="form-group-inline d-inline">
					{!! Form::hidden('keywords', empty($keywords) ? old('keywords') : $keywords) !!}
					<input type="hidden" name="tagword" value="{{$tag->name}}">
					@if (!empty($city)) <input name="cityId" type="hidden" value="{{ $city->id }}"> @endif
					<a href="javascript:form_tag{{$key}}.submit()" class="badge badge-pill badge-info p-1 my-1">
						<h6 class="mb-0 px-1"># {{ $tag->name }}</h6>
					</a>
				</div>
				{!! Form::close() !!}
			@else
				<a href="{{ route('tags.show', ['id' => $tag->id]) }}" class="badge badge-pill badge-info p-1 my-1">
					<h6 class="mb-0 px-1"># {{ $tag->name }}</h6>
				</a>
			@endif
		@endforeach
		</div>
	</div>
</div>
@endif

@if (Request::is('hirosima/cities/*'))
<div class="card bg-white">
	<P class="card-header align-middle">
		<i class="fas fa-tags"></i> タグで絞り込む
	</P>
	<div class="card-body p-2">
		@if (!empty($tagword))
		<div class="select-tag card">
			<div class="card-body p-2">
				<span>選択タグ：</span>
				<a href="{!! route('cities.show', ['id' => $city->id]) !!}" style="text-decoration:none">
					<h6 class="d-inline mb-0 px-1"># {{ $tagword }}</h6><i class="far fa-times-circle"></i>
				</a>
			</div>
		</div>
		@endif
		<div class="tag-items">
		@foreach ($tags as $key => $tag)
			{!! Form::open(['route' => ['cities.show', $city->id], 'method' => 'get', 'name' => "form_tag{$key}", 'class' => 'd-inline']) !!}
			<div class="form-group-inline d-inline">
				<input type="hidden" name="tagword" value="{{$tag->name}}">
				<a href="javascript:form_tag{{$key}}.submit()" class="badge badge-pill badge-info p-1 my-1">
					<h6 class="mb-0 px-1"># {{ $tag->name }}</h6>
				</a>
			</div>
			{!! Form::close() !!}
		@endforeach
		</div>
	</div>
</div>
@endif

@if (Request::is('tags/*'))
<div class="card bg-white">
	<P class="card-header align-middle">
		<i class="fas fa-tags"></i> タグで絞り込む
	</P>
	<div class="card-body p-2">
		@if (!empty($tagword))
		<div class="select-tag card">
			<div class="card-body p-2">
				<span>選択タグ：</span>
				<a href="{!! route('tags.index') !!}" style="text-decoration:none">
					<h6 class="d-inline mb-0 px-1"># {{ $tagword }}</h6><i class="far fa-times-circle"></i>
				</a>
			</div>
		</div>
		@endif
		<div class="tag-items">
			@foreach ($tags as $key => $tag)
				{!! Html::decode(link_to_route('tags.show', "<h6 class='mb-0 px-1'># $tag->name </h6>", ['id' => $tag->id], ['class' => 'badge badge-pill badge-info p-1 my-1'])) !!}
			@endforeach
		</div>
	</div>
</div>
@endif