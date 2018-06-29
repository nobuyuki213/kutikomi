@extends('layouts.app')

@section('title', 'ログイン/ユーザー登録')

@section('navbar')
	@include('commons.navbar')
@endsection

@section('breadcrumbs')
	<nav area-label="breadcrumbs-list">
		<div class="mb-2 bg-primary border-top">
			<ol class="breadcrumb container my-0">
			{!! Html::decode(Breadcrumbs::render('login')) !!}
			</ol>
		</div>
	</nav>
@endsection

@section('content')
<div class="container">
	<div class="mt-2 p-0 col-lg-8 offset-lg-2">
		<div class="card">
			<h3 class="py-lg-5 py-3 text-center">ログイン/ユーザー登録</h3>
			<!-- ピル部分 -->
			<ul class="nav nav-pills nav-justified" id="pills-tab" role="tablist">

				<li class="nav-item">
					<a class="nav-link small active" id="pills-login-tab" data-toggle="pill" href="#pills-login" role="tab" aria-controls="pills-login" aria-selected="true">ログイン</a>
				</li>

				<li class="nav-item">
					<a class="nav-link small" id="pills-signup-tab" data-toggle="pill" href="#pills-signup" role="tab" aria-controls="pills-signup" aria-selected="false">ユーザ登録（無料）</a>
				</li>

			</ul>

			<!-- パネル部分 -->
			<div class="tab-content" id="pills-tabContent">
	{{-- ログイン --}}
				<div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab">
					<div class="card border-0">
						<div class="card-body">

							<div class="row">
								<div class="col-md-6">
									{!! Html::decode(link_to('login/google', '<span class="fab fa-google"></span> Googleでログイン', ['class' => 'mb-2 text-center btn btn-block btn-social btn-google btn-lg'])) !!}
								</div>
								<div class="col-md-6">
									{!! Html::decode(link_to('login/facebook', '<span class="fab fa-facebook"></span> facebookでログイン', ['class' => 'mb-2 text-center btn btn-block btn-social btn-facebook btn-lg'])) !!}
								</div>
							</div>

							{!! Form::open(['route' => 'login.post']) !!}
							<hr>
							<div class="form-group row">
								{!! Form::label('email', 'メールアドレス', ['form-control-label', 'for' => 'input']) !!}
								{!! Form::email('email', old('email'), empty($errors->has('email')) ? ['class' => 'form-control'] : ['class' => 'form-control is-invalid']) !!}
								<div class="invalid-feedback">{{ $errors->first('email') }}</div>
							</div>

							<div class="form-group row">
								{!! Form::label('password', 'パスワード', ['form-control-label', 'for' => 'input']) !!}
								{!! Form::password('password', empty($errors->has('password')) ? ['class' => 'form-control'] : ['class' => 'form-control is-invalid']) !!}
								<div class="invalid-feedback">{{ $errors->first('password') }}</div>
							</div>
							<hr>
							<div class="row">
								{!! Form::button('ログインする', ['class' => 'btn btn-danger btn-lg btn-block', 'type' => 'submit']) !!}
							</div>

							{!! Form::close() !!}
						</div>
						<div class="card-footer">

						</div>
					</div>
				</div>
	{{-- 登録 --}}
				<div class="tab-pane fade" id="pills-signup" role="tabpanel" aria-labelledby="pills-signup-tab">
					<div class="card border-0">
						<div class="card-body">
							{!! Form::open(['route' => 'signup.post']) !!}

							<div class="form-group row">
								{!! Form::label('name', 'お名前', ['form-control-label', 'for' => 'input']) !!}
								{!! Form::text('name', old('name'), empty($errors->has('name')) ? ['class' => 'form-control'] : ['class' => 'form-control is-invalid']) !!}
								<div class="invalid-feedback">{{ $errors->first('name') }}</div>
							</div>

							<div class="form-group row">
								{!! Form::label('email', 'メールアドレス', ['form-control-label', 'for' => 'input']) !!}
								{!! Form::email('email', old('email'), empty($errors->has('email')) ? ['class' => 'form-control'] : ['class' => 'form-control is-invalid']) !!}
								<div class="invalid-feedback">{{ $errors->first('email') }}</div>
							</div>

							<div class="form-group row">
								{!! Form::label('password', 'パスワード', ['form-control-label', 'for' => 'input']) !!}
								{!! Form::password('password', empty($errors->has('password')) ? ['class' => 'form-control'] : ['class' => 'form-control is-invalid']) !!}
								<div class="invalid-feedback">{{ $errors->first('password') }}</div>
							</div>

							<div class="form-group row">
								{!! Form::label('password_confirmation', 'パスワード確認用', ['form-control-label', 'for' => 'input']) !!}
								{!! Form::password('password_confirmation', empty($errors->has('password')) ? ['class' => 'form-control'] : ['class' => 'form-control is-invalid']) !!}
								<div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
							</div>

							<div class="custom-control custom-checkbox">
								{!! Form::checkbox('provider', 0, false, ['class' => 'custom-control-input', 'id' => 'provider0']) !!}
	 							{!! Html::decode(Form::label('provider0', '<a href="#">利用規約</a>を同意の上、会員登録する', ['class' => 'custom-control-label small'])) !!}
							</div>
							<hr>
							<div class="row">
								{!! Form::button('会員登録する（無料）', ['class' => 'btn btn-danger btn-lg btn-block', 'type' => 'submit', 'id' => 'submitBtn0', 'disabled']) !!}
							</div>

							{!! Form::close() !!}
						</div>
						<div class="card-footer">

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
