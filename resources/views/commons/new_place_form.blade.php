<div class="card border-0">

	<div class="collapse" role="tabpanel" id="collapseFormGroup1" aria-labelledby="collapseFormGroupHeading1" aria-expanded="false">

		<div class="place-form card border-0">
			<div class="card-header text-white bg-secondary">
				<h5 class="text-center mb-0">新しくスポットを登録</h5>
			</div>
			<div class="card-body">
			{!! Form::open(['route' => 'reviews.create', 'method' => 'get', 'id' => 'form_new_place']) !!}

				<div class="form-group">
					{!! Form::label('place_name', '施設名', ['class' => 'form-control-label']) !!}
					{!! Form::text('place_name', old('place_name'), empty($errors->has('place_name')) ? ['class' => 'validate[required,maxSize[40]] form-control'] : ['class' => 'validate[required,maxSize[40]] form-control is-invalid']) !!}
					<div class="invalid-feedback">{{ $errors->first('place_name') }}</div>
				</div>

				<div class="form-group">
					{!! Form::label('city_id', '市区町村', ['class' => 'form-control-label']) !!}
					{!! Form::select('city_id', ['' => '選択してください']+array_pluck($select_cities, 'name', 'id'), old('city_id'), empty($errors->has('city_id')) ? ['class' => 'validate[required] form-control'] : ['class' => 'validate[required] form-control is-invalid']) !!}
					<div class="invalid-feedback">{{ $errors->first('city_id') }}</div>
				</div>

				<div class="form-group">
					{!! Form::label('place_desc', '番地', ['class' => 'form-control-label']) !!}
					{!! Form::text('place_desc', old('place_desc'), empty($errors->has('place_desc')) ? ['class' => 'validate[required,maxSize[50]] form-control', 'aria-describedby' => 'place_help'] : ['class' => 'validate[required,maxSize[50]] form-control is-invalid']) !!}
					<small id="place_help" class="form-text text-muted">市区町村の続きをご入力ください [例] 地御前1丁目10-20</small>
					<div class="invalid-feedback">{{ $errors->first('place_desc') }}</div>
				</div>
				<div class="card-footer text-center bg-transparent">
					{!! Form::button('スポットを登録してレビューを書く', ['class' => 'btn btn-secondary btn-lg', 'type' => 'submit'])  !!}
				</div>
			{!! Form::close() !!}
			</div>
		</div>

	</div><!-- /.collapse -->

	<div class="card-header" role="tab" id="collapseFormGroupHeading1">
		<small class="mb-0">
			<a href="#collapseFormGroup1" class="collapsed text-body text-center" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapseFormGroup1"> お探しのスポットが見つからない場合 </a>
		</small>
	</div><!-- /.card-header -->
</div><!-- /.card -->