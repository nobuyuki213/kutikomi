{{-- タブ部分 --}}
<nav>
	<div class="nav nav-tabs nav-fill mb-3" id="nav-tab" role="tablist">

		<a class="nav-item nav-link {{ Request::is('places/review/input/search') ? 'active' : '' }}" id="nav-name-search-tab" href="{{ route('places.review')}}" role="tab"><small>名前<br>で探す</small></a>

		<a class="nav-item nav-link {{ Request::is('places/review/input/search_add') ? 'active' : '' }}" id="nav-address-search-tab" href="{{ route('places.search_add') }}" role="tab"><small>住所<br>で探す</small></a>

	</div>
</nav>