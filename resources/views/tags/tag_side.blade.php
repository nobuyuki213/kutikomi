<li class="nav-item px-lg-1">
	<div class="card card-body bg-light p-2">
		<P class="align-middle mb-2"><i class="fas fa-tags"></i> 人気のタグ</P>
		<div>
		@foreach ($tags as $tag)
			<a href="{!! route('tags.show', ['tag' => $tag]) !!}" class="badge badge-pill badge-info p-1 my-1">
				<h6 class="mb-0 px-1"># {{ $tag->name }}</h6>
			</a>
		@endforeach
		</div>
	</div>
</li>