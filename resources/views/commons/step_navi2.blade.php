{{-- ステップナビ --}}
<div class="mt-4">
	<nav>
		<ol class="cd-breadcrumb cd-multi-steps text-bottom count">
			<li class="visited"><a href="{{ route('places.review')}}"><small>[場所選択変更]</small></a></li>
			<li class="current"><em>レビューを書く</em></li>
			<li><em>ユーザー情報</em></li>
		</ol>
	</nav>
</div>

<div>
	<span class="badge badge-pill badge-secondary">Step2</span>
	<h5>{{ link_to_route('places.show', $place->name, ['id' => $place->id], ['target' => '_blank']) }} のレビューを書く</h5>
	<hr>
</div>