<div class="bg-secondary" style="border: 0.3rem solid #F3969A;">
	<div class="card border-secondary">
		<div class="card-header">該当する場所は{{ empty($places->count()) ? '見つかりませんでした。' : ' '.$places->count().' 件ありました。'}}</div>
		<ul class="list-group list-group-flush">
			@foreach ($places as $key => $place)
			<li class="list-group-item list-group-item-action p-0">
			{!! Form::open(['route' => 'reviews.create', 'method' => 'get', 'name' => "form{$key}"]) !!}
				{!! Form::hidden('place', $place->id) !!}
				<a href="javascript:form{{$key}}.submit()" class="d-block py-4 px-3" style="text-decoration:none;position:relative;">
					{{ $place->name }}
					<small class="text-muted" style="position:absolute;bottom:0.3rem;right:0.3rem;"><i class="fas fa-map-marker-alt"></i> {{ $place->city->name }}</small>
					@if (Session::get("draft.review{$place->id}.place_id") == $place->id)
						<span class="small text-white bg-primary rounded-bottom px-2" style="position:absolute;top:0;left:1rem;"><i class="far fa-edit fa-sm"></i> 下書き</span>
					@endif
				</a>
			{!! Form::close() !!}
			</li>
			@endforeach
		</ul>
	</div>
</div>
<nav class="pagination-lg mx-auto mt-3" style="width: 180px;">
	{{$places->render("pagination::simple-bootstrap-4")}}
</nav>