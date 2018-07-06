@extends('layouts.app')

@section('title', 'レビューの確認')

@section('navbar')
	@include('commons.navbar')
@endsection

@section('content')
<div class="container">

	@include('commons.step_navi2', ['place' => $place])

	<div class="row mx-auto text-center">
		<h5 class="offset-lg-3 col-lg-3 col-12 px-0 text-nowrap">「{{ $place->name }}」</h5>
		<p class="col-lg-2 co-12 px-0 text-nowrap">のレビュー内容を確認</p>
	</div>

</div>
{{-- {{dd($request->rating)}} --}}
<div class="jumbotron jumbotron-fluid">
	<div class="container px-2">
		{!! Form::open(['route' => 'reviews.store']) !!}
		{!! Form::hidden('place', $place->id) !!}
			<div class="review-comfirm card border-0">
				<div class="card-header">レビュー内容をご確認いただき、「レビューを投稿する」ボタンを押していただくと投稿が完了します</div>
				<div class="card-body">
					<div class="content row">
						<div class="content-main col-lg-8">
							<div class="form-group row border-bottom pb-3">
								<div class="col-sm-2 my-auto">
									{!! Form::label('static_comment', '良かった点', ['class' => 'col-form-label text-nowrap']) !!}
								</div>
								<div class="col-md-8 col-sm-10 py-3">
									{!! Form::textarea('good_comment', $request->good_comment, ['class' => 'form-control-plaintext', 'rows' => 4, 'readonly']) !!}
								</div>
								<div class="col-md-2 my-auto text-right">
									<a href="javascript:history.back()" class="btn btn-outline-secondary"><i class="fas fa-undo fa-lg"></i> 変更</a>
								</div>
							</div>
							<div class="form-group row border-bottom border-secondary pb-3">
								<div class="col-sm-2 my-auto">
									{!! Form::label('static_rating', '評価点数', ['class' => 'col-form-label text-nowrap']) !!}
									<h5 class="d-inline-block px-2 b-0"><span class="badge badge-pill badge-secondary">{{ $request->good_rating }}点</span></h5>
								</div>
								<div class="col-md-8 col-sm-10 py-3" style="font-size:2.3rem;">

									@include('commons.static_rating', ['params' => $request->good_rating])

									{!! Form::hidden('good_rating', $request->good_rating, ['class' => 'form-control-plaintext', 'readonly']) !!}
								</div>
								<div class="col-md-2 my-auto text-right">
									<a href="javascript:history.back()" class="btn btn-outline-secondary"><i class="fas fa-undo fa-lg"></i> 変更</a>
								</div>
							</div>
							<div class="form-group row border-bottom pb-3">
								<div class="col-sm-2 my-auto">
									{!! Form::label('static_comment', '気になる点', ['class' => 'col-form-label text-nowrap']) !!}
								</div>
								<div class="col-md-8 col-sm-10 py-3">
									{!! Form::textarea('bad_comment', $request->bad_comment, ['class' => 'form-control-plaintext', 'rows' => 4, 'readonly']) !!}
								</div>
								<div class="col-md-2 my-auto text-right">
									<a href="javascript:history.back()" class="btn btn-outline-secondary"><i class="fas fa-undo fa-lg"></i> 変更</a>
								</div>
							</div>
							<div class="form-group row border-bottom border-secondary pb-3">
								<div class="col-sm-2 my-auto">
									{!! Form::label('static_rating', '評価点数', ['class' => 'col-form-label text-nowrap']) !!}
									<h5 class="d-inline-block px-2 b-0"><span class="badge badge-pill badge-secondary">{{ $request->bad_rating }}点</span></h5>
								</div>
								<div class="col-md-8 col-sm-10 py-3" style="font-size:2.3rem;">

									@include('commons.static_rating', ['params' => $request->bad_rating])

									{!! Form::hidden('bad_rating', $request->bad_rating, ['class' => 'form-control-plaintext', 'readonly']) !!}
								</div>
								<div class="col-md-2 my-auto text-right">
									<a href="javascript:history.back()" class="btn btn-outline-secondary"><i class="fas fa-undo fa-lg"></i> 変更</a>
								</div>
							</div>
						</div>
						<div class="content-side col-lg-4 px-lg-3 px-0">
							<div class="card card-body bg-light border-0">
								{!! Html::decode(Form::button('<i class="far fa-edit"></i> レビューを投稿する', ['class' => 'btn btn-secondary btn-lg py-3 px-4', 'style' => 'font-size:1.7rem;', 'type' => 'submit'])) !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		{!! Form::close() !!}
	</div>
</div>
@endsection