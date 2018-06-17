@extends('layouts.app')

@section('title', 'welcome')

@section('cover')
	<div class="cover">
		<div class="cover-inner">
			<div class="cover-contents col-sm-12">
				<h1 class="display-4">サービスを探そう</h1>
			</div>
		</div>
	</div>
	<!--検索フォームここから　修正必要 最終的にコメント消去-->
	<div class="input-group mb-3 col-md-4 offset-md-4">
		<input type="text" class="form-control border-info" placeholder="廿日市市" aria-label="..." aria-describedby="button-addon2"　style="border: 2px;">
		<div class="input-group-append">
			<button type="button" id="button-addon2" class="btn btn-outline-info">
				<i class="fas fa-search fa-sm"> 検索</i>
			</button>
		</div>
	</div>
	<!--検索フォームここまで　修正必要-->
@endsection

@section('content')

テスト

@endsection