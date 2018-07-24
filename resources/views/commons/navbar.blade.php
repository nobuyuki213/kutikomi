<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top py-3">
	<a class="navbar-brand" href="/">LOGO</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Navber" aria-controls="Navber" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="Navber">
		<ul class="navbar-nav ml-auto">
			<li class="nav-item p-2 p-lg-0">
				@if (Auth::check())
					{!! link_to_route('users.show', 'お気に入り', ['id' => Auth::user()->id], ['class' => 'nav-link d-inline-block mr-lg-0 mr-3']) !!}
					{!! link_to_route('history.places', '閲覧履歴', null, ['class' => 'nav-link d-inline-block']) !!}
				@else
					{!! link_to_route('login', 'お気に入り', null, ['class' => 'nav-link d-inline-block mr-lg-0 mr-3', 'data-toggle' => 'popover', 'data-trigger' => 'hover', 'data-placement' => 'left', 'data-content' => 'お気に入りはログインが必要です']) !!}
					{!! link_to_route('history.places', '閲覧履歴', null, ['class' => 'nav-link d-inline-block']) !!}
				@endif
			</li>
			{{-- <li class="nav-item">
				{!! link_to_route('history.places', '閲覧履歴', null, ['class' => 'nav-link d-inline-block']) !!}
			</li> --}}
			<li class="nav-item">
				{{ link_to_route(!empty(Session::get('draft')) ? 'places.draft' : 'places.review', '口コミを投稿する', null, ['class' => 'nav-link btn btn-secondary btn-lg mb-lg-0 mx-lg-2 mb-3 py-lg-1']) }}
			</li>
			@if (Auth::check())
				<li class="nav-item dropdown pl-5">
					<a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="position:relative;">
						<img src="{{ asset('storage/avatars/'. Auth::user()->avatar) }}" class="img-fluid rounded-circle" style="width:2.2rem;position:absolute;top:0px;left:-33px;" alt="user-small-icon">
						<i class="far fa-user" style="font-size:1.3rem;"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right border-primary" aria-labelledby="navbarDropdown">
						<h6 class="dropdown-header">{{ Auth::user()->name }}</h6>
						<div class="dropdown-divider"></div>
						{!! link_to_route('users.show', 'マイページ', ['id' => Auth::user()->id], ['class' => 'dropdown-item']) !!}
						<div class="dropdown-divider"></div>
						{!! link_to_route('logout.get', 'ログアウト', null, ['class' => 'dropdown-item']) !!}
					</div>
				</li>
			@else
				<li class="nav-item">
					{!! link_to_route('login', 'ログイン/ユーザー登録', null, ['class' => 'nav-link btn text-muted btn btn-light btn-lg mb-lg-0 ml-lg-2 py-lg-1']) !!}
				</li>
			@endif
{{-- 			<li class="nav-item">
				<a class="nav-link disabled" href="#">無効</a>
			</li> --}}
		</ul>
		{{-- <form class="form-inline my-2 my-lg-0">
			<input type="search" class="form-control mr-sm-2" placeholder="Search" aria-label="検索...">
			<button type="submit" class="btn btn-secondary my-2 my-sm-0">Search</button>
		</form> --}}
	</div><!-- /.navbar-collapse -->
</nav>