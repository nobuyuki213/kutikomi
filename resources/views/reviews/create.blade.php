@extends('layouts.app')

@section('title', 'レビューの投稿')

@section('navbar')
	@include('commons.navbar')
@endsection

@section('content')
<div class="container">

	@include('commons.step_navi2', ['place' => $place])

	<div class="row mx-auto text-center">
		<h5 class="offset-lg-3 col-lg-3 col-12 px-0 text-nowrap">「{{ $place->name }}」</h5>
		<p class="col-lg-2 co-12 px-0 text-nowrap">のレビューを書きましょう。</p>
	</div>

</div>
{{-- errorテスト --}}
@if (count($errors) > 0)
	@foreach ($errors->all() as $error)
		{{ $error }}
	@endforeach
@endif
{{-- errorテスト --}}
<div class="jumbotron jumbotron-fluid">
	<div class="container">
		{!! Form::open(['route' => 'reviews.confirm']) !!}
		{!! Form::hidden('place', $place->id) !!}
		<div class="review-create card border-secondary mb-3">
			<div class="card-header border-secondary bg-transparent">ヘッダ</div>
			<div class="card-body px-2">
				{{-- ここからレビュー --}}
				<h4 class="card-title"><i class="far fa-check-circle"></i> レビューを書く</h4>
				<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
{{-- ここからgoodコメント --}}
					<div class="card border-0">
						<div class="card-header bg-success" role="tab" id="heading1">
							<h5 class="mb-0">
								<a class="collapsed text-body d-block" data-toggle="collapse" href="#collapse1" role="button" aria-expanded="true" aria-controls="collapse1">
									<span class="text-white font-weight-bold"><i class="far fa-laugh"></i> 良かった点を書く</span>
								</a>
							</h5>
						</div><!-- /.card-header -->
						<div id="collapse1" class=@if ($errors->has('good_comment') || $errors->has('good_rating')) "collapse show" @else "collapse" @endif role="tabpanel" aria-labelledby="heading1">
							<div class="card-body px-md-3 px-1">
								<div class="form-group">
									{!! Form::textarea('good_comment', old('good_comment'), empty($errors->has('good_comment')) ? ['class' => 'form-control', 'placeholder' => '良い点を教えてください'] : ['class' => 'form-control is-invalid']) !!}
									<div class="invalid-feedback">{{ $errors->first('good_comment') }}</div>
								</div>
								<div class="card card-body border-bottom rounded my-3 p-3">
									<p class="bg-success text-white px-3 py-2">記入のヒント</p>
									<p>どんな場所にあるか？店員の接客はどうか？施設の清潔感はどうか？</p>
								</div>
{{-- ここからgoodレーティング --}}
								<h4 class="card-title"><i class="far fa-check-circle"></i> 良かった点を評価する</h4>
								<div class="form-group">
									<div class="custom-control custom-radio pl-0">
										<div class="evaluation">
											<input class="custom-control-input" id="g-star1" type="radio" name="good_rating" value="5" {{ old('good_rating') == 5 ? 'checked' : '' }}/>
											<label for="g-star1"><span class="text">5</span><i class="fas fa-star"></i></label>
											<input class="custom-control-input" id="g-star2" type="radio" name="good_rating" value="4" {{ old('good_rating') == 4 ? 'checked' : '' }} />
											<label for="g-star2"><span class="text">4</span><i class="fas fa-star"></i></label>
											<input class="custom-control-input" id="g-star3" type="radio" name="good_rating" value="3" {{ old('good_rating') == 3 ? 'checked' : '' }} />
											<label for="g-star3"><span class="text">3</span><i class="fas fa-star"></i></label>
											<input class="custom-control-input" id="g-star4" type="radio" name="good_rating" value="2" {{ old('good_rating') == 2 ? 'checked' : '' }} />
											<label for="g-star4"><span class="text">2</span><i class="fas fa-star"></i></label>
											<input class="custom-control-input" id="g-star5" type="radio" name="good_rating" value="1" {{ old('good_rating') == 1 ? 'checked' : '' }} />
											<label for="g-star5"><span class="text">1</span><i class="fas fa-star"></i></label>
											<span class="my-auto mr-2 py-2 btn btn-outline-secondary" id="undo1"><i class="fas fa-undo fa-lg"></i></span>
										</div>
										@if (!empty($errors->first('good_rating')))
											<div class="alert alert-dismissible alert-secondary">
												<button type="button" class="close" data-dismiss="alert">&times;</button>
												<small><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('good_rating') }}</small>
											</div>
										@endif
									</div>
								</div>
							</div><!-- /.card-body -->
						</div><!-- /.collapse -->
					</div><!-- /.card -->
{{-- ここからbadコメント --}}
					<div class="card border-0 mt-1">
						<div class="card-header bg-danger border border-danger" role="tab" id="heading2">
							<h5 class="mb-0">
								<a class="collapsed text-body d-block" data-toggle="collapse" href="#collapse2" role="button" aria-expanded="false" aria-controls="collapse2">
									<span class="text-white font-weight-bold"><i class="far fa-frown"></i> 気になる点を書く</span>
								</a>
							</h5>
						</div><!-- /.card-header -->
						<div id="collapse2" class=@if ($errors->has('bad_comment') || $errors->has('bad_rating')), "collapse show" @else "collapse" @endif role="tabpanel" aria-labelledby="heading2">
							<div class="card-body px-md-3 px-1 pb-0">
								<div class="form-group">
									{!! Form::textarea('bad_comment', old('bad_comment'), empty($errors->has('bad_comment')) ? ['class' => 'form-control', 'placeholder' => '気になる点を教えてください'] : ['class' => 'form-control is-invalid']) !!}
									<div class="invalid-feedback">{{ $errors->first('bad_comment') }}</div>
								</div>
								<div class="card card-body border-bottom rounded my-3 p-3">
									<p class="bg-danger text-white px-3 py-2">記入のヒント</p>
									<p>どんな場所にあるか？店員の接客はどうか？施設の清潔感はどうか？</p>
								</div>
{{-- ここからbadレーティング --}}
								<h4 class="card-title"><i class="far fa-check-circle"></i> 気になる点を評価する</h4>
								<div class="form-group">
									<div class="custom-control custom-radio pl-0">
										<div class="evaluation">
											<input class="custom-control-input" id="b-star1" type="radio" name="bad_rating" value="5" {{ old('bad_rating') == 5 ? 'checked' : '' }}/>
											<label for="b-star1"><span class="text">5</span><i class="fas fa-star"></i></label>
											<input class="custom-control-input" id="b-star2" type="radio" name="bad_rating" value="4" {{ old('bad_rating') == 4 ? 'checked' : '' }} />
											<label for="b-star2"><span class="text">4</span><i class="fas fa-star"></i></label>
											<input class="custom-control-input" id="b-star3" type="radio" name="bad_rating" value="3" {{ old('bad_rating') == 3 ? 'checked' : '' }} />
											<label for="b-star3"><span class="text">3</span><i class="fas fa-star"></i></label>
											<input class="custom-control-input" id="b-star4" type="radio" name="bad_rating" value="2" {{ old('bad_rating') == 2 ? 'checked' : '' }} />
											<label for="b-star4"><span class="text">2</span><i class="fas fa-star"></i></label>
											<input class="custom-control-input" id="b-star5" type="radio" name="bad_rating" value="1" {{ old('bad_rating') == 1 ? 'checked' : '' }} />
											<label for="b-star5"><span class="text">1</span><i class="fas fa-star"></i></label>
											<span class="my-auto mr-2 py-2 btn btn-outline-secondary" id="undo2"><i class="fas fa-undo fa-lg"></i></span>
										</div>
										@if (!empty($errors->first('bad_rating')))
											<div class="alert alert-dismissible alert-secondary">
												<button type="button" class="close" data-dismiss="alert">&times;</button>
												<small><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('bad_rating') }}</small>
											</div>
										@endif
									</div>
								</div>
							</div><!-- /.card-body -->
						</div><!-- /.collapse -->
					</div><!-- /.card -->
				</div><!-- /#accordion -->
			</div>
			<div class="card-footer border-secondary bg-transparent">Footer</div>
		</div>
		<div class="review-button text-center">
			{!! Form::button('入力内容を確認する', ['class' => 'btn btn-secondary btn-lg', 'type' => 'submit']) !!}
		</div>
		{!! Form::close() !!}
	</div>
</div>


{{-- ポップオーバーテスト用 --}}
<p>
  <a href="#" data-toggle="popover" id="myPopover" data-content="ココにポップオーバーが表示">ポップオーバーの実例</a>
</p>
  <div>
    <p>ポップオーバーを手動で制御するには、以下のボタンを押す。</p>
    <input type="button" class="btn btn-primary toggle-popover" data-trigger="hover" value="表示">
  </div>

@endsection

@section('script')
	{{-- ポップオーバーテスト用 --}}
	<script>
		$(".toggle-popover").hover(function(){
			$("#myPopover").popover('toggle');
		});
	</script>
	{{-- 以下のスクリプトは本採用分のため削除しない --}}
	<script>
		$(function() {
			$("#undo1").click(function() {
			// チェックを外す
			$('input:radio[name="good_rating"]').prop('checked',false);
			});
		});
	</script>
	<script>
		$(function() {
			$("#undo2").click(function() {
			// チェックを外す
			$('input:radio[name="bad_rating"]').prop('checked',false);
			});
		});
	</script>
@endsection