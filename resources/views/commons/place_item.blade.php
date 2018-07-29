@foreach ($places as $key => $place)

	<div class="card mt-2">
		<div class="card-header clearfix">

			@include('commons.favorite', ['place' => $place])

			<a href="{{ route('places.show', ['id' => $place->id]) }}"><h4 class="mb-0 text-muted">{{ $place->name }}</h4></a>
		</div>
		<div class="card-body pt-sm-3 pt-0">

			<div class="media row border-bottom pb-3">
				<span class="col-sm-3 mx-md-3 px-0 text-center">

					@forelse ($place->reviews_with_photos->take(1) as $review)
						@if ($loop->index == 1)
							@break
						@endif
							@if ($review->photos->isNotEmpty())
								<a href="{{ route('places.show', ['id' => $place->id]) }}"><img class="img-fluid img-thumbnail" src="{{ asset(Storage::disk('s3')->url('storage/places/' . $place->id . '/' . $review->photos->whereNotIn('original', null)->random()->original )) }}" alt="place-photo" style="width:100%;height:150px;object-fit:cover;"></a>
							@else
								<a href="{{ route('places.show', ['id' => $place->id]) }}"><i class="far fa-image fa-10x"></i></a>
							@endif
					@empty
						<a href="{{ route('places.show', ['id' => $place->id]) }}"><i class="far fa-image fa-10x"></i></a>
					@endforelse

				</span>
				<div class="media-body col-sm-9 pt-sm-0 pt-3">
					<div class="places-status">
						<small>
							@include('commons.static_rating', ['params' => $place->reviews_rating_avg()])
						</small>
						<h6 class="d-inline-block font-weight-bold text-secondary">
							{{ sprintf('%.2f',$place->reviews_rating_avg()) }}
						</h6>
						<h6 class="d-inline-block font-weight-bold pl-2">
							<i class="far fa-comment-dots fa-flip-horizontal fa-lg"></i> <span class=" text-secondary">{{ $place->reviews->count() }}</span> 件
						</h6>
					</div>
					<div>
						{{ $place->description }}
					</div>
				</div><!-- /.media-body -->
			</div><!-- /.media -->

			<div class="review-examples row py-3 pl-2">
				@forelse ($place->reviews_latest->take(1) as $review)
					@if ($loop->index == 1)
						@break
					@endif
					<div class="balloon5 col-sm-1 col-2 pl-xl-4 pl-md-2 pl-sm-1 px-0">
						<div class="faceicon">
						@if (Storage::disk('s3')->exists('storage/avatars/'.$review->user->id.'/'. $review->user->avatar))
							<img src="{{ asset(Storage::disk('s3')->url('storage/avatars/'. $review->user->id.'/'. $review->user->avatar)) }}" class="img-fluid" alt="user-icon">
						@else
							<img src="{{ asset(Storage::disk('s3')->url('storage/avatars/'. $review->user->avatar)) }}" class="img-fluid" alt="user-icon">
						@endif
						</div>
					</div>
					<div class="chatting card-text col-sm-11 col-10 pl-0">
					<a href="{{ route('place.reviews', ['id' => $place->id]) }}" class="text-muted">
						<div class="says border-secondary">
							<small id="c-show-kuti">{{ $review->comment }}</small>
						</div>
					</a>
					</div>
				@empty
					<div class="col">
						<small>こちらはレビューがありません。</small>
					</div>
				@endforelse
			</div>
			<div class="tags-status">
				<i class="fas fa-tags"></i>
				@foreach ($place->only_tags($place) as $tag)
					<span class="badge badge-pill badge-info p-1 my-1">
						<h6 class="mb-0 px-1"># {{ $tag->name }}</h6>
					</span>
				@endforeach
			</div>
		</div>
		<div class="card-footer p-0">
			{!! Html::decode(link_to_route('places.show', '<i class="fas fa-map-marker-alt"></i> <small>'.$place->name.'</small>', ['id' => $place->id], ['class' => 'btn btn-outline-primary btn-lg btn-block py-2 rounded-0 text-truncate'])) !!}
		</div>
	</div>

@endforeach