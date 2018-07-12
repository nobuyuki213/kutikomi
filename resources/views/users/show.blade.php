@extends('layouts.app')

@section('title', $user->name.' - Mypage')

@section('stylesheet')
	{{-- user avatar upload CSS --}}
	<link rel="stylesheet" type="text/css" href="https://unpkg.com/file-upload-with-preview/dist/file-upload-with-preview.min.css">
		{{-- PhotoSwipe Core CSS --}}
	<link rel="stylesheet" href="{{ asset('js/PhotoSwipe-master/dist/photoswipe.css') }}">
	{{-- PhotoSwipe Skin CSS --}}
	<link rel="stylesheet" href="{{ asset('js/PhotoSwipe-master/dist/default-skin/default-skin.css') }}">
@endsection

@section('navbar')
	@include('commons.navbar')
@endsection

@section('content')
<div class="jumbotron jumbotron-fluid">
	<div class="container-fluid" id="user-page">
		<div class="user-header">
			<div class="media row" style="position:relative;">
				<a href="#" class="mr-3 col-3">
					<img src="{{ asset('storage/avatars/'.$user->avatar) }}" class="img-fluid rounded-circle" alt="user-icon">
				</a>
				<!-- 切り替えボタンの設定 -->
				<a class="text-secondary bg-light rounded-circle" data-toggle="modal" data-target="#UserIconModal" style="position:absolute;bottom:0.2rem;left:18vmin;">
					<i class="fas fa-plus-circle" style="font-size:calc(0.6rem + 2.5vmin)"></i>
				</a>
				<div class="media-body">
					<h3 class="mt-0" style="font-size:calc(0.6rem + 2.2vmin)">{{ $user->name }}</h3>
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
					<a class="nav-link rounded-circle" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="far fa-edit py-2 pl-md-1"></i></a>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="container-fluid" id="user-page">
	<!-- パネル部分 -->
	<div class="tab-content" id="pills-tabContent">
		<div class="tab-pane fade show active" id="pills-favorite" role="tabpanel" aria-labelledby="pills-favorite-tab">
			<div class="favorite-main row">

				@foreach ($user->favorite_places as $place)
					<div class="card card-body rounded-0 col-6 p-2 p-lg-3">
						<div class="favorite-status clearfix pb-2 border-bottom">

							<div class="favorite">
								@include('commons.favorite', ['place' => $place])
							</div>

							<small class="">add:
								 @include('commons.date', ['date' => $place->pivot->created_at])
							</small>
						</div>
						<h6 class="card-title my-2" style="font-size:calc(0.5rem + 1.8vmin);height:2rem">{{ $place->name }}</h6>
						<div class="places-status mb-2">

							<small style="font-size:calc(0.3rem + 1.2vmin);">
								@include('commons.static_rating', ['params' => $place->reviews_rating_avg()])
							</small>

							<h6 class="d-inline-block text-secondary mb-0">
								{{ sprintf('%.2f', $place->reviews_rating_avg()) }}
							</h6>
							<h6 class="d-inline-block pl-2 mb-0">
								<i class="far fa-comment fa-flip-horizontal fa-lg"></i> <span class=" text-secondary">{{ $place->reviews->count() }}</span>
							</h6>
						</div>
						{{-- <span class="mx-auto"> --}}
							{!! Html::decode(link_to_route('places.show', 'Go Page <i class="fas fa-angle-double-right"></i>', $place->id, ['class' => 'btn btn-sm btn-secondary'])) !!}
						{{-- </span> --}}
					</div>
				@endforeach


			</div>
		</div>
		<div class="tab-pane fade" id="pills-review" role="tabpanel" aria-labelledby="pills-review-tab">
			<div class="reviews-main card-body px-0">

					@include('reviews.reviews', ['reviews' => $reviews])

			</div>
		</div>
		<div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
			コンタクトの文章です。...
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

				{!! Form::open(['route' => 'update.avatar', 'files' => 'true']) !!}
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
@endsection