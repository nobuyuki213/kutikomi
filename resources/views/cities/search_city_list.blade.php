<div class="bg-secondary" style="border: 0.3rem solid #F3969A;">
	<div class="card border-secondary">
		<div class="card-header">住所で探す</div>
		<ul class="list-group list-group-flush">
			@foreach ($cities as $key => $city)
			<li class="list-group-item list-group-item-action clearfix p-0">
			{!! Form::open(['route' => 'places.search_add', 'method' => 'get', 'name' => "form{$key}"]) !!}
				{!! Form::hidden('city', $city->id) !!}
				<a href="javascript:form{{$key}}.submit()" class="d-block p-4" style="text-decoration:none;">
					{{ $city->name }}
					<span class="badge badge-pill badge-primary float-right">{{ $city->places()->count() }}</span>
				</a>
			{!! Form::close() !!}
			</li>
			@endforeach
		</ul>
	</div>
</div>
<nav class="pagination-lg mx-auto mt-3" style="width: 180px;">
	{{$cities->render("pagination::simple-bootstrap-4")}}
</nav>