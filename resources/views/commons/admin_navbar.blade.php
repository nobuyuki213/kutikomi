<nav class="navbar header-top fixed-top navbar-expand-lg navbar-dark bg-primary">
	<a class="navbar-brand" href="/">LOGO</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
	aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarText">

		<ul class="navbar-nav side-nav">
			<li class="nav-item">
				<a class="nav-link" href="#">Home
					<span class="sr-only">(current)</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Side Menu Items</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Pricing</a>
			</li>
			<li class="nav-item px-2">
				<form class="form-group">
					<input type="search" class="form-control mb-2" placeholder="Search" aria-label="検索...">
					<button type="submit" class="btn btn-info border">Search</button>
				</form>
			</li>
		</ul>

		<ul class="navbar-nav ml-md-auto d-md-flex">
			<li class="nav-item">
				<a class="nav-link" href="#">お気に入り</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">閲覧履歴</a>
			</li>
			@if (Auth::check())
				<li class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					{{ Auth::user()->name }}
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="#">{{ Auth::user()->name }}</a>
						<div class="dropdown-divider"></div>
						{{ link_to_route('logout.get', 'ログアウト', null, ['class' => 'dropdown-item']) }}
					</div>
				</li>
			@else
				<li class="nav-item">
					{{ link_to_route('login.get', 'ログイン/ユーザー登録', null, ['class' => 'nav-link']) }}
				</li>
			@endif
		</ul>

	</div>
</nav>