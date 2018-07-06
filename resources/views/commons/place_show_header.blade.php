<div class="placeheader container">
	<div class="row mt-3">
		<div class="col px-2">
			<div class="card">
				<img class="card-img-top" src="..." alt="カードの画像">
				<div class="card-body clearfix p-md-4 p-2">
					<P class="float-right"><i class="far fa-star fa-2x"></i></p>
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
					<p class="card-text">＜タグ＞やplaceに関する関連情報</p>
					<p class="card-text"><small class="text-muted">最終更新3分前</small></p>
				</div>
			</div>
		</div>
	</div>
</div>