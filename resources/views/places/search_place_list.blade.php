<div class="bg-secondary" style="border: 0.3rem solid #F3969A;">
	<div class="card border-secondary">
		<div class="card-header">該当する場所は{{ $places->count() > 0 ? ' '.$places->count().' 件ありました。' : 'ありませんでした。'}}</div>
		<ul class="list-group list-group-flush">
			@foreach ($places as $place)
			<li class="list-group-item list-group-item-action p-0">
				<a href="#" class="d-block p-4" style="text-decoration:none;">
					{{ $place->name }}
				</a>
			</li>
			@endforeach
		</ul>
	</div>
</div>
<nav class="pagination-lg mx-auto mt-3" style="width: 180px;">
	{{$places->render("pagination::simple-bootstrap-4")}}
</nav>