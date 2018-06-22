@extends('layouts.app')

@section('title', $place->name.'の口コミ･評価')

@section('content_f')

<div>
	＜パンくずリスト生成＞
</div>

以下は投稿用のステップ用
	<nav class="row">
		<ol class="cd-breadcrumb cd-multi-steps text-bottom count">
			<li class="visited"><a href="#0">Home</a></li>
			<li class="current"><em>Gallery</em></a></li>
			<li><em>Web</em></li>
			<li><em>Project</em></li>
		</ol>
	</nav>

<div class="row">
	<div class="col px-2">
		<div class="card">
			<img class="card-img-top" src="..." alt="カードの画像">
			<div class="card-body">
				<h5 class="card-title">{{ $place->name }}</h5>
				<p class="card-text">これは、追加コンテンツへの自然な導入として以下のテキストをサポートする、より幅広いカードです。このコンテンツはもう少し長くなります。</p>
				<p class="card-text"><small class="text-muted">最終更新3分前</small></p>
			</div>
		</div>
	</div>
</div>

@endsection