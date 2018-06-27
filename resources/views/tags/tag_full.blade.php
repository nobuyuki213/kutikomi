<div class="tag card mt-3">
	<div class="card-header clearfix">
		<div>
			{!! Html::decode(link_to_route('tags.index', 'タグ一覧 <i class="fas fa-chevron-circle-right"></i>', null, ['class' => 'float-right btn btn-secondary'])) !!}
		</div>
		<div class="text-center">
			<h3 class="align-middle text-secondary"><i class="fas fa-tags"></i> 人気のタグから探す</h3>
		</div>
	</div>
	<div class="card-body text-center px-2">
	@foreach ($tags as $tag)
		<a href="#" class="badge badge-pill badge-info p-2 m-1">
			<h6 class="mb-0"># {{ $tag->name }} <span class="badge badge-pill badge-light align-top">{{ $tag->places()->count() }}</span></h6>
		</a>
	@endforeach
	</div>
	<div class="card-footer">フッタ</div>
</div>