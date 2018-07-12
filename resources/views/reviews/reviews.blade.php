@foreach ($reviews as $review)
{{-- {{dd($review)}} --}}
	<div class="mx-0 mb-4">
		<div class="card">
			<h5 class="card-header bg-transparent py-2 {{ $review->photos->isNotEmpty() ? '' : 'border-bottom-0'}}">
				<div class="media">
					<a href="#" class="mr-3">
						<img src="{{ asset('storage/avatars/' . $review->user->avatar) }}" class="img-fluid rounded-circle" style="max-width:25px;" alt="user-icon">
					</a>
					<div class="media-body">
						<span class="my-auto" style="font-size:0.8rem;">{{ $review->user->name}}</span>
					</div><!-- /.media-body -->
				</div><!-- /.media -->
			</h5>
			@if ($review->photos->isNotEmpty())
			<div class="card-body p-0">

				<div class="place-gallery">
				@foreach ($review->photos as $photo)
				@if (Request::is('users/*'))
					@php
					$place->id = $review->places()->value('place_id')
					@endphp
				@endif
					<figure class="figure mb-0 px-0" style="width:100%;">
						<a href="{{ asset('storage/places/'.$place->id.'/'.$photo->original) }}" data-size="1000x666">

						@switch($review->photos->count())
							@case(1)
								<img class="img-fluid" src="{{ asset('storage/places/'.$place->id.'/'.$photo->original) }}" alt="place-review-photo" style="width:100%;max-height:300px;object-fit:cover;">
								@break
							@case(2)
								<img class="img-fluid col-6 px-0" src="{{ asset('storage/places/'.$place->id.'/'.$photo->original) }}" alt="place-review-photo" style="width:100%;max-height:300px;object-fit:cover;">
								@break
							@case(3)
								<img class="img-fluid col-4 px-0" src="{{ asset('storage/places/'.$place->id.'/'.$photo->original) }}" alt="place-review-photo" style="width:100%;max-height:300px;object-fit:cover;">
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
							{!! $review->places()->value('type') == 'good' ? '<i class="far fa-laugh text-secondary"></i>' : '<i class="far fa-frown text-success"></i>' !!}
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
					<small class="float-right">
						created_at: {{ $review->creationTimes() }}
					</small>
					@if (Request::is('users/*'))
					{!! link_to_route('places.show', $review->places()->value('name'), ['id' => $review->places()->value('place_id')], ['class' => 'small float-left badge badge-pill badge-secondary font-weight-normal']) !!}
					@endif
				</div>
			</div>
		</div>
	</div>
@endforeach