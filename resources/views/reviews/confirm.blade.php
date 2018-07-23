@extends('layouts.app')

@section('title', 'レビューの確認')

@section('stylesheet')
	<link rel="stylesheet" type="text/css" href="https://unpkg.com/file-upload-with-preview/dist/file-upload-with-preview.min.css">
@endsection

@section('navbar')
	@include('commons.navbar')
@endsection

@section('content')
<div class="container">
{{-- session test 用 --}}
{{-- <pre>
	{{  print_r(Session::all()) }}
</pre> --}}
{{-- session test 用　ここまで --}}
	@include('commons.step_navi2', !empty($place) ? ['place' => $place] : ['request' => $request])

	<div class="text-center m-2">
		<h6 class="d-md-inline-block">「{{ !empty($place->name) ? $place->name : $request->place_name }}」</h6>
		<span class="">のレビュー内容を確認。</span>
	</div>

</div>
<div class="jumbotron jumbotron-fluid">
	<div class="container px-2">
		{!! Form::open(['route' => 'reviews.store', 'files' => 'true']) !!}
		@if (!empty($place))
			{!! Form::hidden('place', $place->id) !!}
		@else
			{!! Form::hidden('place_name', $request->place_name) !!}
			{!! Form::hidden('city_id', $request->city_id) !!}
			{!! Form::hidden('place_desc', $request->place_desc) !!}
		@endif
			<div class="review-comfirm card border-0">
				<div class="card-header">
					<p>レビュー内容をご確認ください <span class="badge badge-secondary font-weight-normal p-2" style="font-size:1rem"><i class="far fa-edit"></i> レビューを投稿する</span> ボタンを押していただくと投稿が完了します</p>
				</div>
				<div class="card-body">
					<div class="content row">
						<div class="content-main col-lg-8">
							@if (!empty($request->good_comment))
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
							@endif
							@if (!empty($request->bad_comment))
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
							@endif
							@if (count($errors) > 0)
							@foreach ($errors->all() as $error)
								<div class="alert alert-danger small mb-1">{{ $error }}</div>
							@endforeach
							@endif
							<div class="form-group row border-bottom border-secondary pb-3">
								<div class="col-sm-2 my-auto">
									{!! Form::label('photo', 'フォト', ['class' => 'col-form-label text-nowrap']) !!}
								</div>
								<div class="col-md-10 col-sm-10 my-3">

									{{-- ここからphoto upload --}}
									<div class="card border-0">
										<div class="card-header bg-secondary border-0" role="tab" id="heading2">
											<h5 class="mb-0">
												<a class="collapsed text-body d-block" data-toggle="collapse" href="#collapse3" role="button" aria-expanded="false" aria-controls="collapse3">
													<span class="text-white font-weight-bold"><i class="fas fa-camera-retro"></i> フォトをアップする</span>
												</a>
											</h5>
										</div><!-- /.card-header -->
										<div id="collapse3" class=@if ($errors->has('photo')) "collapse show" @else "collapse" @endif role="tabpanel" aria-labelledby="heading2">
											<div class="card-body px-md-3 px-1 pb-0">
												<h5 class="card-title"><i class="far fa-check-circle"></i> アップするフォトを選んでください</h5>
												<p class="small text-danger">最大画像サイズは 1500px x 1500px までになります</p>

												{{-- 画像アップフォーム --}}
												<div class="form-group mb-0">
													<div class="custom-file-container" data-upload-id="photoUniqueUploadId">
														@if ($errors->has('photo'))
															<small class="d-block">画像アップのエラーメッセージが表示された場合は、 <strong>[リセット]</strong> を押した後に再度ファイルを選択してください</small>
														@endif
														<label>フォトを <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">[ リセット ]</a></label>

														<label class="custom-file-container__custom-file" >
															{!! Form::file('photo', ['class' => 'custom-file-container__custom-file__custom-file-input']) !!}
															<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
															<span class="custom-file-container__custom-file__custom-file-control"></span>
														</label>
														<div class="custom-file-container__image-preview"></div>
													</div>
												</div>

											</div><!-- /.card-body -->
										</div><!-- /.collapse -->
									</div><!-- /.card -->

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

@section('script')

	<script src="https://unpkg.com/file-upload-with-preview"></script>
	<script>
		var upload = new FileUploadWithPreview('photoUniqueUploadId')
	</script>

@endsection