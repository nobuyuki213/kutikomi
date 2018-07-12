@if (Auth::check())
	@if (Auth::user()->is_favorite($place->id))
		{!! Form::open(['route' => ['user.unfavorite', $place->id], 'method' => 'delete', 'name' => empty($key) ? "form" : "form{$key}"])!!}
			<a href="javascript:form{{ empty($key) ? '' : $key}}.submit()" class="float-right mb-0 text-danger">
				<i class="fas fa-heart fa-2x"></i>
			</a>
		{!! Form::close() !!}
	@else
		{!! Form::open(['route' => ['user.favorite', $place->id], 'name' => empty($key) ? "form" : "form{$key}"])!!}
			<a href="javascript:form{{ empty($key) ? '' : $key}}.submit()" class="float-right mb-0">
				<i class="far fa-heart fa-2x text-muted"></i>
			</a>
		{!! Form::close() !!}
	@endif
@else
	<p class="float-right mb-0" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="お気に入りはログインが必要です"><i class="far fa-heart fa-2x"></i></p>
@endif