@extends('layouts.app')

@section('title', $place->name.'の口コミ・評価マップ')

@section('stylesheet')

@endsection

@section('navbar')
	@include('commons.navbar')
@endsection

@section('breadcrumbs')
	<nav area-label="breadcrumbs-list">
		<div class="mb-2 bg-primary border-top">
			<ol class="breadcrumb container my-0">
			{!! Html::decode(Breadcrumbs::render('map', $place)) !!}
			</ol>
		</div>
	</nav>
@endsection

@section('content')

	@include('commons.place_show_header', ['place' => $place])

	@include('commons.place_show_navscroll', ['place' => $place])

<div class="container" id="container">
	<div class="content row">
		<div class="content-header col-lg-8 offset-lg-2 px-2">
			<div class="map crad my-2 border-0">
				<div class="card-header text-center h-100 py-0 bg-transparent">
					<div class="">
						<div class="fa-7x text-secondary">
							<i class="fas fa-map-marked-alt"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid px-0">
	<div class="content-main-map">
		<div id="place_show_map">
			<iframe src="https://www.google.co.jp/maps?q={{$place->name}}&output=embed&t=m&z=18&hl=ja" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
	</div>
</div>
@endsection

@section('script')

	@include('commons.place_show_script')

@endsection