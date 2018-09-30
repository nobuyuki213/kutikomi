@extends('layouts.app')

@section('navbar')
	@include('commons.navbar')
@endsection

@section('content')
<div class="container mt-5">
	<div class="row">
		<div class="card border-0 col-lg-8 mx-auto">
			<div class="card-body shadow-sm" style="background:rgb(240,240,240)">
				<h2 class="my-5 text-center">404 Not Found</h2>
				<div class="section mb-5">
					<p class="text-center">
						<span class="d-block d-lg-inline">大変申し訳ございません。</span>
						<span>お探しのページは見つかりませんでした。</span>
					</p>
				</div>
				<div class="text-center mb-5">
					{!! link_to(env('APP_URL'), 'TOPページへ', ['class' => 'btn btn-outline-info']) !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection