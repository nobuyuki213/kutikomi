<div style="border: 0.3rem solid #F3969A; background-color: #F3969A;">
	<div class="card border-secondary">
		<div class="card-header">ヘッダ</div>
		<table class="table table-hover table-lg mb-0">
			@foreach ($cities as $city)
			<tr>
				<td>
				<a href="#" class="d-block" style="text-decoration:none;">
					{{ $city->name }}
				</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
</div>
<nav class="pagination-lg mx-auto mt-3" style="width: 180px;">
	{{$cities->render("pagination::simple-bootstrap-4")}}
</nav>