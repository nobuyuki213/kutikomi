@foreach ($d_reviews as $key => $d_review)
@php
	$place = App\Place::find($d_review['place_id']);
@endphp
<div class="draft-review card @if($loop->last) mb-0 @else mb-3 @endif">
	<div class="card-body p-0" style="position:relative;">
		<!-- 切り替えボタンの設定 -->
		<span class="btn btn-sm btn-dark" data-toggle="modal" data-target="#draftDeleteModal{{ $place->id }}" style="position:absolute;top:0.3rem;right:0.3rem;">
			<i class="far fa-trash-alt fa-lg"></i>
		</span>
		{!! Form::open(['route' => 'reviews.create', 'method' => 'get', 'name' => "form_review{$key}"]) !!}
			{!! Form::hidden('place', $place->id) !!}
			<a href="javascript:form_review{{$key}}.submit()" class="d-block p-lg-3 p-2" style="text-decoration:none">
				<div class="draft-status">

					<p class="small text-muted mb-2">[updated at]<span class="ml-1">{{ !empty($d_review['updated_at']) ? $d_review['updated_at'] : $d_review['history_at'] }}</span></p>
				</div>
				<h5 class="text-muted mb-3">{{ $place->name }}</h5>
				<div class="draft-write-status">
					<div class="good-status mb-md-0 mb-1 mr-1 d-inline-block">
						<span class="badge badge-primary font-weight-normal p-2">良かった点</span>
						<span class="mx-1 text-muted">{{ !empty($d_review['good_comment']) ? '記入あり' : '未記入' }}</span>
						<span class="badge badge-primary font-weight-normal p-2">評価点</span>
						@if (!empty($d_review['good_rating']))
							<small>@include('commons.static_rating', ['params' => $d_review['good_rating']])</small>
							<h6 class="d-inline-block font-weight-bold text-secondary">{{  $d_review['good_rating'] }}</h6>
						@else
						<span class="mx-1 text-muted">未選択</span>
						@endif
					</div>
					<div class="bad-status mb-md-0 mb-1 mr-1 d-inline-block">
						<span class="badge badge-danger font-weight-normal p-2">気になる点</span>
						<span class="mx-1 text-muted">{{ !empty($d_review['bad_comment']) ? '記入あり' : '未記入' }}</span>
						<span class="badge badge-danger font-weight-normal p-2">評価点</span>
						@if (!empty($d_review['bad_rating']))
							<small>@include('commons.static_rating', ['params' => $d_review['bad_rating']])</small>
							<h6 class="d-inline-block font-weight-bold text-secondary">{{  $d_review['bad_rating'] }}</h6>
						@else
						<span class="mx-1 text-muted">未選択</span>
						@endif
					</div>
					<div class="tags-status d-md-inline d-block">
						<span class="badge badge-info font-weight-normal p-2">タグ</span>
						<span class="mx-1 text-muted">{{ !empty($d_review['tag_ids']) ? '選択あり' : '未選択' }}</span>
					</div>
				</div>
			</a>
		{!! Form::close() !!}
	</div>
</div>
<!-- モーダルの設定 -->
<div class="modal fade" id="draftDeleteModal{{ $place->id }}" tabindex="-1" role="dialog" aria-labelledby="draftDeleteModal{{ $place->id }}Label" aria-hidden="true">
	<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="draftDeleteModal{{ $place->id }}Label">下書きの削除</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
					<span aria-hidden="true"><i class="fas fa-times"></i></span>
				</button>
			</div>
			<div class="modal-body text-center">
				<p>" {{ $place->name }} "</p>
				<span>の下書きを削除しますか？</span>
			</div>
			<div class="modal-footer text-center justify-content-center p-2">
				<button type="button" class="btn btn-primary btn-lg mx-3" data-dismiss="modal">キャンセル</button>
				{!! Form::open(['route' => ['delete.draft', $place->id], 'method' => 'delete', 'name' => "form_draft{$key}"])!!}
				<a href="javascript:form_draft{{$key}}.submit()" class="btn btn-danger btn-lg mx-3">
					OK
				</a>
			{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@endforeach