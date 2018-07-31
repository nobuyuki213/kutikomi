@extends('layouts.app')

@section('title', $user->name.' - Mypage')

@section('stylesheet')
	{{-- user avatar upload CSS --}}
	<link rel="stylesheet" type="text/css" href="https://unpkg.com/file-upload-with-preview/dist/file-upload-with-preview.min.css">
	{{-- PhotoSwipe Core CSS --}}
	<link rel="stylesheet" href="{{ asset('js/PhotoSwipe-master/dist/photoswipe.css') }}">
	{{-- PhotoSwipe Skin CSS --}}
	<link rel="stylesheet" href="{{ asset('js/PhotoSwipe-master/dist/default-skin/default-skin.css') }}">
	{{-- validationEngine.CSS --}}
	<link rel="stylesheet" href="{{ asset('js/jQuery-Validation-Engine-master/css/validationEngine.jquery.css') }}">
@endsection

@section('navbar')
	@include('commons.navbar')
@endsection

@section('content')
<div class="jumbotron jumbotron-fluid">
	<div class="container-fluid" id="user-page">
		<div class="user-header">
			<div class="media row" style="position:relative;">
				<a href="#" class="mx-md-4 mx-3 col-3 pl-0 pr-2">
				@if (Storage::disk('s3')->exists('storage/avatars/'.$user->id.'/'.$user->avatar))
					<img src="{{ asset(Storage::disk('s3')->url('storage/avatars/'.$user->id.'/'.$user->avatar)) }}" class="img-fluid rounded-circle" alt="user-icon">
				@else
					<img src="{{ asset(Storage::disk('s3')->url('storage/avatars/'.$user->avatar)) }}" class="img-fluid rounded-circle" alt="user-icon">
				@endif
				</a>
				<!-- 切り替えボタンの設定 -->
				<span class="text-secondary bg-light rounded-circle" data-toggle="modal" data-target="#UserIconModal" style="position:absolute;bottom:0.3rem;left:19.5vmin;">
					<i class="fas fa-plus-circle" style="font-size:calc(0.6rem + 2.5vmin)"></i>
				</span>
				<div class="media-body">
					<div class="nickname-status pr-3">
						<h3 class="d-inline" style="font-size:calc(0.6rem + 2.2vmin)">{{ $user->nickname }}</h3>
						<div class="dropdown d-inline-block ml-1">
							<span class="fa-stack dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size:calc(0.3rem + 1.3vmin)" data-offset="15,5">
								<i class="fas fa-circle fa-stack-2x text-secondary"></i>
								<i class="fas fa-user-edit fa-stack-1x fa-inverse"></i>
							</span>
							<div class="dropdown-menu dropdown-menu-right border-primary" style="width:15rem">
							{!! Form::open(['route' => ['nickname.update', $user->id], 'method' => 'put', 'class' => 'px-2 py-2', 'id' => 'formname']) !!}
								<div class="form-group">
									{!! Form::label('nickname', 'ニックネームの変更', ['class' => 'form-control-label']) !!}
									{!! Form::text('nickname', $user->nickname, ['class' => 'validate[required,minSize[6],custom[onlyNickName],maxSize[20]] form-control', 'aria-describedby' => 'nicknameHelp']) !!}
									<small id="nicknameHelp" class="form-text form-muted">半角英数字と一部記号[-_.]のみ入力できます</small>
								</div>
								{!! Form::button('変更', ['class' => 'btn btn-primary btn-sm w-100', 'type' => 'submit']) !!}
							{!! Form::close()  !!}
							</div>
						</div>
					</div>
				</div><!-- /.media-body -->
			</div><!-- /.media -->
			<!-- ピル部分 -->
			<ul class="nav nav-pills justify-content-center mt-4" id="pills-tab" role="tablist" style="font-size:calc(0.9rem + 2.2vmin)">
				<li class="nav-item mx-3">
					<a class="nav-link rounded-circle active" id="pills-favorite-tab" data-toggle="pill" href="#pills-favorite" role="tab" aria-controls="pills-favorite" aria-selected="true"><i class="far fa-heart py-2 px-md-1"></i></a>
				</li>
				<li class="nav-item mx-3">
					<a class="nav-link rounded-circle" id="pills-review-tab" data-toggle="pill" href="#pills-review" role="tab" aria-controls="pills-review" aria-selected="false"><i class="far fa-comment py-2 px-md-1"></i></a>
				</li>
				<li class="nav-item mx-3">
					<a class="nav-link rounded-circle" id="pills-draft-tab" data-toggle="pill" href="#pills-draft" role="tab" aria-controls="pills-draft" aria-selected="false"><i class="far fa-edit py-2 pl-md-1"></i></a>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="container-fluid" id="user-page">
	<!-- パネル部分 -->
	<div class="tab-content" id="pills-tabContent">
		<div class="tab-pane fade show active" id="pills-favorite" role="tabpanel" aria-labelledby="pills-favorite-tab">
			@if (count($favorites) > 0)
				<div class="favorite-main row">
					@foreach ($favorites as $key => $place)
						<div class="card rounded-0 col-6 p-2 p-lg-3">
							<div class="card-body p-0">
								<div class="favorite-status clearfix pb-2 border-bottom">

									<div class="favorite">
										@include('commons.favorite', ['place' => $place, 'key' => $key])
									</div>

									<small class="">add:
										 @include('commons.date', ['date' => $place->pivot->created_at])
									</small>
								</div>
								<h5 id="p-name" class="card-title my-2">{{ $place->name }}</h5>
							</div>
							<div class="crad-footer place-status-wrapper">
								@php
									$place = App\Place::withCount('reviews')->find($place->id);
								@endphp
								<small class="d-inline-block mt-1 align-text-top" style="font-size:calc(0.3rem + 1.2vmin);">
									@include('commons.static_rating', ['params' => $place->reviews_rating_avg()])
								</small>

								<h6 class="d-inline-block text-secondary mb-0 align-bottom">
									{{ sprintf('%.2f', $place->reviews_rating_avg()) }}
								</h6>
								<h6 class="d-inline-block pl-1 mb-0 align-bottom">
									<i class="far fa-comment fa-flip-horizontal fa-lg"></i> <span class=" text-secondary">{{ $place->reviews_count }}</span>
								</h6>
								<div>
									{!! Html::decode(link_to_route('places.show', 'Go Page <i class="fas fa-angle-double-right"></i>', $place->id, ['class' => 'btn btn-sm btn-secondary mt-2 d-block'])) !!}
								</div>
							</div>
						</div>
					@endforeach
				</div>
			@else
				<div class="alert alert-info text-center text-white border-0">
					お気に入りしているのはありません。
				</div>
			@endif

		</div>
		<div class="tab-pane fade" id="pills-review" role="tabpanel" aria-labelledby="pills-review-tab">
			@if (count($reviews) > 0)
				<div class="reviews-main">

					@include('reviews.reviews', ['reviews' => $reviews])

				</div>
			@else
				<div class="alert alert-info text-center text-white border-0">
					登録した口コミはありません。
				</div>
			@endif
		</div>
		<div class="tab-pane fade" id="pills-draft" role="tabpanel" aria-labelledby="pills-draft-tab">
			@if ($d_reviews->count() > 0)
				<div class="draft-reviews">
					@include('commons.draft_reviews' , ['d_reviews' => $d_reviews])
				</div>
			@else
				<div class="alert alert-info text-center">
					レビューの下書きはありません
				</div>
			@endif

			<nav class="pagination-lg mx-auto mt-3" style="width: 180px;">
				{{ $d_reviews->render("pagination::simple-bootstrap-4") }}
			</nav>
		</div>
	</div>
</div>

<!-- user avatar 変更用モーダル -->
<div class="modal fade" id="UserIconModal" tabindex="-1" role="dialog" aria-labelledby="UserIconModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="UserIconModalLabel">アイコンの画像を変える</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
					<span aria-hidden="true"><i class="fas fa-times"></i></span>
				</button>
			</div>
			<div class="modal-body">

				{!! Form::open(['route' => 'avatar.update', 'files' => 'true']) !!}
					<div class="form-group mb-0">
						<div class="custom-file-container" data-upload-id="myUniqueUploadId">
							<label>画像をアップロード <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">[取消]</a></label>

							<label class="custom-file-container__custom-file" >
								{!! Form::file('avatar', ['class' => 'custom-file-container__custom-file__custom-file-input']) !!}
								<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
								<span class="custom-file-container__custom-file__custom-file-control"></span>
							</label>
							<div class="custom-file-container__image-preview"></div>
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">閉じる</button>
							{!! Form::button('変更する', ['type' => 'submit', 'class' => 'btn btn-primary btn-lg']) !!}
						</div><!-- /.modal-footer -->
					</div>
				{!! Form::close() !!}

			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


@endsection

@section('script')

	{{-- user avatar upload sprict --}}
	<script src="https://unpkg.com/file-upload-with-preview"></script>
	<script>
		var upload = new FileUploadWithPreview('myUniqueUploadId')
	</script>
	{{-- PhotoSwipe Core javascript --}}
	<script src="{{ asset('js/PhotoSwipe-master/dist/photoswipe.min.js') }}"></script>
	{{-- PhotoSwipe UI javascript --}}
	<script src="{{ asset('js/PhotoSwipe-master/dist/photoswipe-ui-default.min.js') }}"></script>
	{{-- PhotoSwipe (追加外部ファイル) --}}
	<script src="{{ asset('js/PhotoSwipe-master/dist/photoswipe-sub.js') }}"></script>
	{{-- validationEngine.jquery --}}
	<script src="{{ asset('js/jQuery-Validation-Engine-master/js/jquery-1.8.2.min.js') }}"></script>
	<script src="{{ asset('js/jQuery-Validation-Engine-master/js/jquery.validationEngine.js') }}"></script>
	<script src="{{ asset('js/jQuery-Validation-Engine-master/js/languages/jquery.validationEngine-ja.js') }}"></script>
	<script>
		$(function(){
			jQuery("#formname").validationEngine('attach', {
				promptPosition: "inline"
			});
		});
	</script>
@endsection