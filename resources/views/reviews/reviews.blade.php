@foreach ($reviews as $review)
{{-- {{dd($review)}} --}}
	<div class="mx-0 mb-4">
		<div class="card">
			<h5 class="card-header bg-transparent">
				<div class="media">
					<a href="#" class="mr-3">
						<img src="..." alt="メディアの画像">
					</a>
					<div class="media-body">
						<span class="my-auto" style="font-size:0.8rem;">{{ $review->user->name}}</span>
					</div><!-- /.media-body -->
				</div><!-- /.media -->
			</h5>
			<div class="card-body">
				<img class="card-img" src="..." alt="カードの画像">
			</div>
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
				<div class="revire-footer pt-2">
					<span class="small float-right">
						created_at: {{ $review->creationTimes() }}
					</span>
				</div>
			</div>
		</div>
	</div>
@endforeach