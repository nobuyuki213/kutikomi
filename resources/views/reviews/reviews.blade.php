@foreach ($reviews as $key => $review)
	<div class="mx-0 mb-4">
		<div class="card">
			<h5 class="card-header bg-transparent py-2 {{ !empty($review->photos) ? '' : 'border-bottom-0'}}">
				<div class="media">
					<a href="#" class="mr-3">
					@if ($review->user->avatar != 'default.jpg')
						<img src="{{ asset(Storage::disk('s3')->url('storage/avatars/'.$review->user->id.'/'. $review->user->avatar)) }}" class="img-fluid rounded-circle" style="max-width:25px;" alt="user-icon">
					@else
						<img src="{{ asset(Storage::disk('s3')->url('storage/avatars/'. $review->user->avatar)) }}" class="img-fluid rounded-circle" style="max-width:25px;" alt="user-icon">
					@endif
					</a>
					<div class="media-body">
						<span class="my-auto" style="font-size:0.8rem;">{{ $review->user->nickname}}</span>
					</div><!-- /.media-body -->
				</div><!-- /.media -->
			</h5>
			@if (!empty($review->photos))
			<div class="card-body p-0">

				<div class="place-gallery">

				@foreach ($review->photos as $photo)

				@if (Request::is('users/*'))
					@php
						$place_id = data_get($review->places['0'], 'id')
					@endphp
				@else
					@php
						$place_id = data_get($review->places['0'], 'id')
					@endphp
				@endif

					<figure class="figure mb-0 px-0" style="width:100%;">
						<a href="{{ asset(Storage::disk('s3')->url('storage/places/'.$place_id.'/'.$photo->original)) }}" data-size="1000x666">

						@switch(count($review->photos))
							@case(1)
								<img class="img-fluid" src="{{ asset(Storage::disk('s3')->url('storage/places/'.$place_id.'/'.$photo->original)) }}" alt="place-review-photo" style="width:100%;max-height:300px;object-fit:cover;">
								@break
							@case(2)
								<img class="img-fluid col-6 px-0" src="{{ asset(Storage::disk('s3')->url('storage/places/'.$place_id.'/'.$photo->original)) }}" alt="place-review-photo" style="width:100%;max-height:300px;object-fit:cover;">
								@break
							@case(3)
								<img class="img-fluid col-4 px-0" src="{{ asset(Storage::disk('s3')->url('storage/places/'.$place_id.'/'.$photo->original)) }}" alt="place-review-photo" style="width:100%;max-height:300px;object-fit:cover;">
								@break
						@endswitch

						</a>
					</figure>

				@endforeach
				</div>

				@include('commons.photoswipe')

			</div>
			@endif
			<div class="card-footer">
				<div class="review-header">
					<span class="fa-lg align-text-bottom">
					@if (!empty($review->pivot->type))
						{!! ($review->pivot->type == 'good') ? '<i class="far fa-laugh text-secondary"></i>' : '<i class="far fa-frown text-success"></i>' !!}
					@else
						{!! data_get($review->places['0'], 'pivot.type') == 'good' ? '<i class="far fa-laugh text-secondary"></i>' : '<i class="far fa-frown text-success"></i>' !!}
					@endif
					</span>
					<span class="small">
						@include('commons.static_rating', ['params' => empty($review->rating) ? 0 : $review->rating])
					</span>
					<h6 class="d-inline-block font-weight-bold text-secondary mb-0">
							{{ empty($review->rating) ? 0 : $review->rating }}
					</h6>
				</div>
				<div class="review-comment">
					<div class="review-lead border-bottom py-2">
						{{ $review->comment }}
					</div>
				</div>
				<div class="review-footer pt-2 clearfix">
				@if (Request::is('users/*'))
					{!! link_to_route('places.show', data_get($review->places[0], 'name'), ['id' => data_get($review->places[0], 'id')], ['class' => 'small float-left badge badge-pill badge-secondary font-weight-normal', 'style' => 'max-width:65%;overflow:hidden;text-overflow:ellipsis;']) !!}
				@else
					<small class="float-right">created_at:
						 @include('commons.date', ['date' => $review->created_at])
					</small>
					{{-- <small class="float-right">
						created_at: {{ $review->creationTimes() }}
					</small> --}}
				@endif
				</div>
			</div>
		</div>
	</div>
@endforeach