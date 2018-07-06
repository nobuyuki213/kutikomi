@foreach ($places as $place)

	<div class="card mt-2">
		<div class="card-header clearfix">
			<p class="float-right mb-0" style="font-size:1.2rem;"><i class="far fa-star fa-lg"></i></p>
			<h4 class="mb-0"><span class="mt-auto">{{ $place->name }}</span></h4>
		</div>
		<div class="card-body">

			<div class="media row border-bottom pb-3">
				<a href="#" class="mr-3 col-sm-3">
					<img src="..." alt="メディアの画像">
				</a>
				<div class="media-body col-sm-9">
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

			<div class="row py-3">
				<div class="balloon5 col-md-1 col-2 px-1">
					<div class="faceicon">
						★ここに画像を入れる <img~>★
					</div>
				</div>
				<div class="chatting card-text col-md-11 col-10 pl-0">
					<div class="says border-secondary">
					@forelse ($place->reviews_latest as $review)
						@if ($loop->index == 1)
							@break
						@endif
							<small id="c-show-kuti">{{ $review->comment }}</small>
					@empty
						<small>こちらはレビューがありません。</small>
					@endforelse
					</div>
				</div>
			</div>
			<i class="fas fa-tags"></i>
			@foreach ($place->tags as $tag)
				<a href="{!! route('tags.show', ['tag' => $tag]) !!}" class="badge badge-pill badge-info p-1 my-1">
					<h6 class="mb-0 px-1"># {{ $tag->name }}</h6>
				</a>
			@endforeach
		</div>
		<div class="card-footer">
			詳細ページリンク（ボタンor範囲指定扱い）
			{!! Html::decode(link_to_route('places.show', '<i class="fas fa-map-marker-alt"></i> <small>'.$place->name.'</small>', ['id' => $place->id])) !!}
		</div>
	</div>

@endforeach