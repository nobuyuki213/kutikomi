<div class="place-header container">
	<div class="row mt-3">
		<div class="col px-2">
			<div class="card">

				@forelse ($place->reviews_with_photos->take(1) as $review)
					@if ($loop->index == 1)
						@break
					@endif
						@if ($review->photos->isNotEmpty())
							<img class="card-img-top img-fluid" src="{{ asset(Storage::disk('s3')->url('storage/places/' . $place->id . '/' . $review->photos->whereNotIn('original', null)->random()->original )) }}" alt="place-orignal-photo" style="width:100%;height:200px;object-fit:cover;">
						@endif
				@empty
					<img class="card-img-top img-fluid" src="{{ asset(Storage::disk('s3')->url('storage/places/default_noimage.png')) }}" alt="default-image" style="width:100%;height:200px;object-fit:cover;">
				@endforelse

				<div class="card-body clearfix p-md-4 p-2">

					@include('commons.favorite', ['place' => $place])

					<h4 class="card-title">{{ $place->name }}</h4>
					<div class="places-status mb-1">

						@include('commons.static_rating', ['params' => $place->reviews_rating_avg()])

						<h5 class="d-inline-block font-weight-bold text-secondary mb-0">
							{{ sprintf('%.2f', $place->reviews_rating_avg()) }}
						</h5>
						<h6 class="d-inline-block font-weight-bold pl-2 mb-0">
							<i class="far fa-comment-dots fa-flip-horizontal fa-lg"></i> <span class=" text-secondary">{{ $place->reviews->count() }}</span> 件
						</h6>
					</div>
					<div class="tags-status mt-3">
						<i class="fas fa-tags"></i>
						@foreach ($place->only_tags($place) as $tag)
							<a href="{!! route('tags.show', ['tag' => $tag]) !!}" class="badge badge-pill badge-info p-1 my-1">
								<h6 class="card-text mb-0 px-1"># {{ $tag->name }}</h6>
							</a>
						@endforeach
						<p class="card-text float-md-right mt-2">
							<small><i class="fas fa-map-marker-alt"></i> {{ $place->city->name }}</small>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>