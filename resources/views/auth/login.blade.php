@extends('layouts.app')

@section('title', 'login')

@section('content')

<div class="mt-5 p-0 col-lg-8 offset-lg-2">
	<div class="card">
{{-- テスト用 --}}
@if (count($errors) > 0)
	@foreach ($errors->all() as $error)
		<div class="alert alert-warning text-center mb-0">{{ $error }}</div>
	@endforeach
@endif
{{-- テスト用ここまで --}}
		<h2 class="py-lg-5 py-3 text-center">ログイン/ユーザー登録</h2>
		<!-- ピル部分 -->
		<ul class="nav nav-pills mb-3 nav-justified" id="pills-tab" role="tablist">

			<li class="nav-item">
				<a class="nav-link active" id="pills-login-tab" data-toggle="pill" href="#pills-login" role="tab" aria-controls="pills-login" aria-selected="true">ログイン</a>
			</li>

			<li class="nav-item">
				<a class="nav-link" id="pills-signup-tab" data-toggle="pill" href="#pills-signup" role="tab" aria-controls="pills-signup" aria-selected="false">ユーザ登録（無料）</a>
			</li>

		</ul>

		<!-- パネル部分 -->
		<div class="tab-content" id="pills-tabContent">
{{-- ログイン --}}
			<div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab">
								<div class="card border-0">
					<div class="card-body">
						{!! Form::open(['route' => 'login.post']) !!}

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
							{!! Form::button('ログインする', ['class' => 'btn btn-danger btn-lg btn-block', 'type' => 'submit']) !!}

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
								{!! Form::label('name', 'ニックネーム', ['form-control-label', 'for' => 'input']) !!}
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
							{!! Form::button('会員登録する（無料）', ['class' => 'btn btn-danger btn-lg btn-block', 'type' => 'submit', 'id' => 'submitBtn0', 'disabled']) !!}

						{!! Form::close() !!}
					</div>
					<div class="card-footer">

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection