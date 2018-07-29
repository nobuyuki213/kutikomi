<div class="step-nav mt-4">
	<nav>
		<ol class="cd-breadcrumb cd-multi-steps text-bottom count">
			<li class="visited"><a href="{{ route('places.review')}}"><small>[場所選択変更]</small></a></li>
			<li class="current"><em>レビューを書く</em></li>
			<li><em>投稿完了</em></li>
		</ol>
	</nav>
</div>
<div class="review-write" style="position:relative">
	<span class="badge badge-pill badge-secondary">Step2</span>
	@if (request()->session()->has('draft_message'))
	<span class="small d-inline-block alert alert-dismissible alert-primary py-2" style="position:absolute;top:-1.5rem;right:0rem;padding-right:2rem;padding-left:0.5rem;opacity:0.8;">
		<button type="button" class="close px-2 py-1" data-dismiss="alert">&times;</button>
		{{ request()->session()->get('draft_message') }}
	</span>
	@endif
	@if (!empty($place))
		<h5>{{ link_to_route('places.show', '「'.$place->name.'」', ['id' => $place->id], ['target' => '_blank']) }} のレビューを書く</h5>
	@else
		<h5>「{{ $request->place_name }}」 のレビューを書く</h5>
	@endif
	<hr>
</div>