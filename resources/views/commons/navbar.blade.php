<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top py-3">
	<a class="navbar-brand" href="/">LOGO</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Navber" aria-controls="Navber" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="Navber">
		<ul class="navbar-nav ml-auto">
			<li class="nav-item">
				<a class="nav-link" href="#">お気に入り</a>
			</li>
			<li class="nav-item">
				{!! link_to_route('history.get', '閲覧履歴', null, ['class' => 'nav-link']) !!}
			</li>
			<li class="nav-item">
				{{ link_to_route('places.review', '口コミを投稿する', null, ['class' => 'nav-link']) }}
			</li>
			@if (Auth::check())
				<li class="nav-item dropdown pl-5">
					<a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="position:relative;">
						<img src="{{ asset('storage/avatars/'. Auth::user()->avatar) }}" class="img-fluid rounded-circle" style="width:2.5rem;position:absolute;top:-2px;left:-38px;" alt="user-small-icon">
						<i class="far fa-user" style="font-size:1.5rem;"></i>
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
					{!! link_to_route('login', 'ログイン/ユーザー登録', null, ['class' => 'nav-link']) !!}
				</li>
			@endif
{{-- 			<li class="nav-item">
				<a class="nav-link disabled" href="#">無効</a>
			</li> --}}
		</ul>
		<form class="form-inline my-2 my-lg-0">
			<input type="search" class="form-control mr-sm-2" placeholder="Search" aria-label="検索...">
			<button type="submit" class="btn btn-secondary my-2 my-sm-0">Search</button>
		</form>
	</div><!-- /.navbar-collapse -->
</nav>