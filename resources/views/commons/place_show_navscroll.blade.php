<div class="navbar bg-dark my-3 px-1 pb-0" id="nav-scroll">
	<div class="nav-scroller box-shadow mx-auto">
		<nav class="nav-underline">
			<ul class="nav nav-tabs">
				<li class="nav-item"><a href="{{ route('places.show', ['id' => $place->id]) }}" class="{{ Request::is('hirosima/cities/places/'.$place->id) ? 'nav-link active' : 'nav-link' }}">概要</a></li>
				<li class="nav-item">
					<a class="{{ Request::is('hirosima/cities/places/*/reviews') ? 'nav-link active' : 'nav-link' }}" href="{{ route('place.reviews', ['id' => $place->id]) }}">
                    <i class="far fa-comments fa-lg"></i> <span>口コミ</span>
                    <span class="badge badge-pill bg-light align-text-bottom text-secondary">{{ $place->reviews->count() }}</span>
                    </a>
                </li>
				<li class="nav-item"><a href="#" class="nav-link"><i class="far fa-images fa-lg"></i> <span>フォト</span></a></li>
				<li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-map-marked"></i> <span>マップ</span></a></li>
				<li class="nav-item"><a href="#" class="nav-link"  data-offset="0,5" data-placement="right" data-toggle="tooltip" title="マップ"><i class="fas fa-map-marked"></i></a></li>
				<li class="nav-item"><a href="#" class="nav-link">リンク1</a></li>
				<li class="nav-item"><a href="#" class="nav-link">リンク2</a></li>
				<li class="nav-item"><a href="#" class="nav-link disabled">無効</a></li>
			</ul>
		</nav>
	</div>
</div>