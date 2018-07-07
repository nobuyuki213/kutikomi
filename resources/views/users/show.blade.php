@extends('layouts.app')

@section('title', $user->name.' - Mypage')

@section('stylesheet')
	<link rel="stylesheet" type="text/css" href="https://unpkg.com/file-upload-with-preview/dist/file-upload-with-preview.min.css">
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
				<a class="text-secondary bg-light rounded-circle" data-toggle="modal" data-target="#myModal" style="position:absolute;bottom:0.2rem;left:18vmin;">
					<i class="fas fa-plus-circle" style="font-size:calc(0.6rem + 2.5vmin)"></i>
				</a>
				<div class="media-body">
					<h3 class="mt-0" style="font-size:calc(0.6rem + 2.2vmin)">{{ $user->name }}</h3>
				</div><!-- /.media-body -->
			</div><!-- /.media -->



			<!-- ピル部分 -->
			<ul class="nav nav-pills justify-content-center mt-4" id="pills-tab" role="tablist" style="font-size:calc(0.9rem + 2.2vmin)">
				<li class="nav-item mx-3">
					<a class="nav-link rounded-circle active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="far fa-heart py-2 px-md-1"></i></a>
				</li>
				<li class="nav-item mx-3">
					<a class="nav-link rounded-circle" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="far fa-comment py-2 px-md-1"></i></a>
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
		<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">ホームの文章です。...</div>
		<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
			<div class="reviews-main card-body px-0">

					@include('reviews.reviews', ['reviews' => $reviews])

			</div>
		</div>
		<div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">コンタクトの文章です。...</div>
	</div>
</div>

<!-- user-icon変更用モーダル -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">アイコンの画像を変える</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
					<span aria-hidden="true"><i class="far fa-window-close"></i></span>
				</button>
			</div>
			<div class="modal-body">

				{!! Form::open(['route' => 'update.avatar', 'files' => 'true']) !!}
					<div class="form-group">
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

	<script src="https://unpkg.com/file-upload-with-preview"></script>
	<script>
		var upload = new FileUploadWithPreview('myUniqueUploadId')
	</script>

@endsection