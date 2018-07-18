<!--検索フォームここから　修正必要 最終的にコメント消去-->
{!!  Form::open(['route' => 'search', 'method' => 'get']) !!}
<div class="form-group">
	<div class="input-group mb-3">
		{!! Form::text('keywords', empty($keywords['keywords']) ? old('keywords') : $keywords['keywords'], ['class' => 'form-control border border-info py-3', 'placeholder' => '施設名など', 'aria-describedby' => "button-addon2"]) !!}
		<div class="input-group-append">
			{!! Form::button('<i class="fas fa-search fa-lg"></i>', ['class' => 'btn btn-info px-lg-5 px-md-4 px-3', 'id' => 'button-addon2', 'type' => 'submit']) !!}
		</div>
	</div>
</div>
{!! Form::close() !!}
<!--検索フォームここまで　修正必要-->