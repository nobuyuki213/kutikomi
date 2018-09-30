@extends('layouts.app')

@section('title', 'レビューの投稿')

@section('stylesheet')

@endsection

@section('navbar')
	@include('commons.navbar')
@endsection

@section('content')
<div class="container">
{{-- session test 用 --}}
{{-- <pre>
	{{  print_r(request()->session()->get('message')) }}
</pre> --}}
{{-- <pre>
	{{  print_r(Session::get("draft.review{$place->id}")) }}
</pre>
<pre>
	{{  print_r($d_review) }}
</pre> --}}
{{-- session test 用　ここまで --}}
	@include('commons.step_navi2', !empty($place) ? ['place' => $place] : ['request' => $request])

	<div class="text-center m-2">
		<h6 class="d-md-inline-block">「{{ !empty($place->name) ? $place->name : $request->place_name }}」</h6>
		<span class="">のレビューを書きましょう</span>
	</div>

</div>
{{-- errorテスト --}}
{{-- @if (count($errors) > 0)
	@foreach ($errors->all() as $error)
		{{ $error }}
	@endforeach
@endif --}}
{{-- errorテスト --}}
<div class="jumbotron jumbotron-fluid">
	<div class="container">
		{!! Form::open(['route' => 'reviews.confirm', 'files' => 'true']) !!}
		@if (!empty($place))
			{!! Form::hidden('place', $place->id) !!}
		@else
			{!! Form::hidden('place_name', $request->place_name) !!}
			{!! Form::hidden('city_id', $request->city_id) !!}
			{!! Form::hidden('place_desc', $request->place_desc) !!}
		@endif
		<div class="review-create card border-secondary mb-3">
			<div class="card-header border-secondary bg-transparent">
				<h4 class="card-title mb-0"><i class="far fa-edit"></i> レビューを書く</h4>
			</div>
			<div class="card-body px-2">
				{{-- ここからレビュー --}}
				<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
					{{-- ここからgoodコメント --}}
					<div class="card border-0">
						<div class="card-header bg-success rounded-0" role="tab" id="heading1">
							<h5 class="mb-0">
								<a class="collapsed text-body d-block" data-toggle="collapse" href="#collapse1" role="button" aria-expanded="true" aria-controls="collapse1">
									<span class="text-white font-weight-bold"><i class="far fa-laugh"></i> 良かった点を書く</span>
								</a>
							</h5>
						</div><!-- /.card-header -->
						<div id="collapse1" class=@if ($errors->has('good_comment') || $errors->has('good_rating') || !empty($d_review['good_comment']) || !empty($d_review['good_rating'])) "collapse show" @else "collapse" @endif role="tabpanel" aria-labelledby="heading1">
							<div class="card-body px-md-3 px-1">
								<h5 class="card-title"><i class="far fa-check-circle"></i> 良かった点を書きましょう</h5>
								<div class="form-group">
									{!! Form::textarea('good_comment', !empty($d_review['good_comment']) ? $d_review['good_comment'] : old('good_comment'), empty($errors->has('good_comment')) ? ['class' => 'form-control', 'placeholder' => '良かった点を教えてください'] : ['class' => 'form-control is-invalid']) !!}
									<div class="invalid-feedback">{{ $errors->first('good_comment') }}</div>
								</div>
								<div class="card card-body border-bottom rounded my-3 p-3">
									<p class="bg-success text-white px-3 py-2">記入のヒント</p>
									<p>どんな場所にあるか？店員の接客はどうか？施設の清潔感はどうか？</p>
								</div>
								{{-- ここからgoodレーティング --}}
								<h5 class="card-title"><i class="far fa-check-circle"></i> 良かった点を評価する</h5>
								<div class="form-group mb-0">
									<div class="custom-control custom-radio pl-0">
										<div class="evaluation">
											@php
											!empty($d_review['good_rating']) ? $g_rating = $d_review['good_rating'] : $g_rating = old('good_rating')
											@endphp
											<input class="custom-control-input" id="g-star1" type="radio" name="good_rating" value="5" {{ $g_rating == 5 ? 'checked' : '' }} />
											<label for="g-star1"><span class="text">とても満足</span><i class="fas fa-star"></i></label>
											<input class="custom-control-input" id="g-star2" type="radio" name="good_rating" value="4" {{ $g_rating == 4 ? 'checked' : '' }} />
											<label for="g-star2"><span class="text">満足</span><i class="fas fa-star"></i></label>
											<input class="custom-control-input" id="g-star3" type="radio" name="good_rating" value="3" {{ $g_rating == 3 ? 'checked' : '' }} />
											<label for="g-star3"><span class="text">普通</span><i class="fas fa-star"></i></label>
											<input class="custom-control-input" id="g-star4" type="radio" name="good_rating" value="2" {{ $g_rating == 2 ? 'checked' : '' }} />
											<label for="g-star4"><span class="text">不満</span><i class="fas fa-star"></i></label>
											<input class="custom-control-input" id="g-star5" type="radio" name="good_rating" value="1" {{ $g_rating == 1 ? 'checked' : '' }} />
											<label for="g-star5"><span class="text">とても不満</span><i class="fas fa-star"></i></label>
											<span class="my-auto mr-2 py-2 btn btn-outline-secondary" id="undo1"><i class="fas fa-undo fa-lg"></i></span>
										</div>
										@if (!empty($errors->first('good_rating')))
											<small class="text-secondary"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('good_rating') }}</small>
										@endif
									</div>
								</div>
							</div><!-- /.card-body -->
						</div><!-- /.collapse -->
					</div><!-- /.card -->
					{{-- ここからbadコメント --}}
					<div class="card border-0 mt-1">
						<div class="card-header bg-danger border border-danger rounded-0" role="tab" id="heading2">
							<h5 class="mb-0">
								<a class="collapsed text-body d-block" data-toggle="collapse" href="#collapse2" role="button" aria-expanded="false" aria-controls="collapse2">
									<span class="text-white font-weight-bold"><i class="far fa-frown"></i> 気になる点を書く</span>
								</a>
							</h5>
						</div><!-- /.card-header -->
						<div id="collapse2" class=@if ($errors->has('bad_comment') || $errors->has('bad_rating') || !empty($d_review['bad_comment']) || !empty($d_review['bad_rating'])) "collapse show" @else "collapse" @endif role="tabpanel" aria-labelledby="heading2">
							<div class="card-body px-md-3 px-1 pb-0">
								<h5 class="card-title"><i class="far fa-check-circle"></i> 気になる点を書きましょう</h5>
								<div class="form-group">
									{!! Form::textarea('bad_comment', !empty($d_review['bad_comment']) ? $d_review['bad_comment'] : old('bad_comment'), empty($errors->has('bad_comment')) ? ['class' => 'form-control', 'placeholder' => '気になる点を教えてください'] : ['class' => 'form-control is-invalid']) !!}
									<div class="invalid-feedback">{{ $errors->first('bad_comment') }}</div>
								</div>
								<div class="card card-body border-bottom rounded my-3 p-3">
									<p class="bg-danger text-white px-3 py-2">記入のヒント</p>
									<p>どんな場所にあるか？店員の接客はどうか？施設の清潔感はどうか？</p>
								</div>
								{{-- ここからbadレーティング --}}
								<h5 class="card-title"><i class="far fa-check-circle"></i> 気になる点を評価する</h5>
								<div class="form-group mb-0">
									<div class="custom-control custom-radio pl-0">
										<div class="evaluation">
											@php
											!empty($d_review['bad_rating']) ? $b_rating = $d_review['bad_rating'] : $b_rating = old('bad_rating')
											@endphp
											<input class="custom-control-input" id="b-star1" type="radio" name="bad_rating" value="5" {{ $b_rating == 5 ? 'checked' : '' }}/>
											<label for="b-star1"><span class="text">とても満足</span><i class="fas fa-star"></i></label>
											<input class="custom-control-input" id="b-star2" type="radio" name="bad_rating" value="4" {{ $b_rating == 4 ? 'checked' : '' }} />
											<label for="b-star2"><span class="text">満足</span><i class="fas fa-star"></i></label>
											<input class="custom-control-input" id="b-star3" type="radio" name="bad_rating" value="3" {{ $b_rating == 3 ? 'checked' : '' }} />
											<label for="b-star3"><span class="text">普通</span><i class="fas fa-star"></i></label>
											<input class="custom-control-input" id="b-star4" type="radio" name="bad_rating" value="2" {{ $b_rating == 2 ? 'checked' : '' }} />
											<label for="b-star4"><span class="text">不満</span><i class="fas fa-star"></i></label>
											<input class="custom-control-input" id="b-star5" type="radio" name="bad_rating" value="1" {{ $b_rating == 1 ? 'checked' : '' }} />
											<label for="b-star5"><span class="text">とても不満</span><i class="fas fa-star"></i></label>
											<span class="my-auto mr-2 py-2 btn btn-outline-secondary" id="undo2"><i class="fas fa-undo fa-lg"></i></span>
										</div>
										@if (!empty($errors->first('bad_rating')))
											<small class="text-secondary"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('bad_rating') }}</small>
										@endif
									</div>
								</div>
							</div><!-- /.card-body -->
						</div><!-- /.collapse -->
					</div><!-- /.card -->
				</div><!-- /#accordion -->
			</div>
			{{-- <div class="card-footer border-secondary bg-transparent">Footer</div> --}}
		</div>
		<div class="place-select-tags card border-secondary mb-3">
			<div class="card-header border-secondary bg-transparent">
				<h4 class="card-title mb-0"><i class="fas fa-tag"></i> タグを選ぶ</h4>
			</div>
			<div class="card-body px-2">

				<div class="card border-0">
					<div class="card-header bg-info rounded-0" role="tab" id="collapseTagSelectHeading1">
						<h5 class="mb-0">
							<a href="#collapseTagSelect1" class="collapsed text-body" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTagSelect1">
							<span class="text-white font-weight-bold">スポットのタグを選ぶ</span>
						</a>
						</h5>
					</div><!-- /.card-header -->
					<div class="{!! empty($d_review['tag_ids']) ? 'collapse' : 'collapse show' !!}" role="tabpanel" id="collapseTagSelect1" aria-labelledby="collapseTagSelectHeading1" aria-expanded="false">

						<div class="tags card-body p-2">
							<div class="form-group">
								<div class="form-inline">
								@if (!empty($tags))
									@foreach ($tags as $key => $tag)
									<div class="custom-control custom-checkbox m-1">
										<input type="checkbox" class="custom-control-input" name="tag_ids[]" value="{{ $tag->id }}" id="Check{{$key}}" @if (!empty($d_review['tag_ids'])) @foreach ($d_review['tag_ids'] as $tag_id) @if ($tag_id == $tag->id) {{ 'checked' }} @break @endif @endforeach @endif>
										<label class="custom-control-label" for="Check{{$key}}">{{ $tag->name }}</label>
									</div>
									@endforeach
								@endif
								</div>
							</div>
						</div>
{{-- <pre>
	{{ var_dump($d_review['tag_ids']) }}
</pre> --}}
						<div class="card-footer text-center text-md-left">"{{ !empty($place->name) ? $place->name : $request->place_name }}"に<span class="d-md-inline d-block">当てはまるタグを選びましょう！</span></div>
					</div><!-- /.collapse -->
				</div><!-- /.card -->

			</div>
		</div>
		<div class="review-button text-center">
			{!! Form::button('入力内容を確認する', ['class' => 'btn btn-secondary btn-lg', 'type' => 'submit']) !!}
		</div>
		{!! Form::close() !!}
	</div>
</div>


{{-- ポップオーバーテスト用 --}}
{{-- <p>
  <a href="#" data-toggle="popover" id="myPopover" data-content="ココにポップオーバーが表示">ポップオーバーの実例</a>
</p>
<div>
<p>ポップオーバーを手動で制御するには、以下のボタンを押す。</p>
<input type="button" class="btn btn-primary toggle-popover" data-trigger="hover" value="表示">
</div> --}}

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