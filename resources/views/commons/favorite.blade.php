@if (Auth::check())
	@if (Auth::user()->is_favorite($place->id))
		<P class="float-right mb-0 text-danger" data-toggle="modal" data-target="#favoriteModal{{ $place->id }}">
			<i class="fas fa-heart fa-2x"></i>
		</P>
		<div class="modal fade" id="favoriteModal{{ $place->id }}" tabindex="-1" role="dialog" aria-labelledby="favoriteModal{{ $place->id }}Title" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
				<div class="modal-content text-center">
					<div class="modal-header">
						<h5 class="modal-title w-100 mx-auto" id="favoriteModal{{ $place->id }}Title" style="position:relative;">お気に入りの変更</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="閉じる" style="position:absolute;top:14px;right:15px">
							<span aria-hidden="true"><i class="fas fa-times"></i></span>
						</button>
					</div>
					<div class="modal-body text-center">
						<p>" {{ $place->name }} "</p>
						<span>をお気に入りから外しますか？</span>
						{{-- <p class="mb-0 text-danger"><i class="fas fa-heart fa-2x"></i></p> --}}
					</div>
					<div class="modal-footer justify-content-center p-2">
						<button type="button" class="btn btn-primary btn-lg mx-3" data-dismiss="modal">キャンセル</button>
						{!! Form::open(['route' => ['user.unfavorite', $place->id], 'method' => 'delete', 'name' => empty($key) ? "form" : "form{$key}"])!!}
							<a href="javascript:form{{ empty($key) ? '' : $key}}.submit()" class="btn btn-danger btn-lg mx-3">
								OK
							</a>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
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

