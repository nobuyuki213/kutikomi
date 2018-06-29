<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top py-3">
	<a class="navbar-brand" href="/">LOGO</a>
	<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#Navber" aria-controls="Navber" aria-expanded="false" aria-label="ナビゲーションの切替">
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
			@if (Auth::check())
				<li class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					{{ Auth::user()->name }}
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="#">{{ Auth::user()->name }}</a>
						<div class="dropdown-divider"></div>
						{!! link_to_route('logout.get', 'ログアウト', null, ['class' => 'dropdown-item']) !!}
					</div>
				</li>
			@else
				<li class="nav-item">
					{{ link_to_route('login.get', 'ログイン/ユーザー登録', null, ['class' => 'nav-link']) }}
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