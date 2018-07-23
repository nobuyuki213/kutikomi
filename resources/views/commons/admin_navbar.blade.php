<nav class="navbar header-top fixed-top navbar-expand-lg navbar-dark bg-primary py-3">
	<a class="navbar-brand" href="/">LOGO</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
	aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarText">

		<ul class="navbar-nav side-nav">
{{-- 			<li class="nav-item">
				<a class="nav-link" href="#">Home
					<span class="sr-only">(current)</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Side Menu Items</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Pricing</a>
			</li> --}}
			{!!  Form::open(['route' => 'search', 'method' => 'get']) !!}
			<li class="nav-item">
				<div class="form-group">
					<div class="input-group mb-3">
						{!! Form::text('keywords', empty($keywords) ? old('keywords') : $keywords, ['class' => 'form-control border border-info py-3', 'placeholder' => '施設名など', 'aria-describedby' => "button-addon2"]) !!}
						<div class="input-group-append">
							{!! Form::button('<i class="fas fa-search fa-lg"></i>', ['class' => 'btn btn-info px-3', 'id' => 'button-addon2', 'type' => 'submit']) !!}
						</div>
					</div>
				</div>
			</li>
			{!! Form::close() !!}
			@if (!empty($tags) && $tags->isNotEmpty())
			<li class="nav-item">
				@include('tags.tag_side', ['tags' => $tags])
			</li>
			@endif
		</ul>

		<ul class="navbar-nav ml-md-auto d-md-flex">
			<li class="nav-item">
				@if (Auth::check())
					{!! link_to_route('users.show', 'お気に入り', ['id' => Auth::user()->id], ['class' => 'nav-link']) !!}
				@else
					{!! link_to_route('login', 'お気に入り', null, ['class' => 'nav-link', 'data-toggle' => 'popover', 'data-trigger' => 'hover', 'data-placement' => 'bottom', 'data-content' => 'お気に入りはログインが必要です']) !!}
				@endif
			</li>
			<li class="nav-item">
				{!! link_to_route('history.places', '閲覧履歴', null, ['class' => 'nav-link']) !!}
			</li>
			<li class="nav-item">
				{{ link_to_route(!empty(Session::get('draft')) ? 'places.draft' : 'places.review', '口コミを投稿する', null, ['class' => 'nav-link btn btn-secondary btn-sm mb-lg-0 mb-3 px-lg-3 mx-lg-2']) }}
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
					{!! link_to_route('login', 'ログイン/ユーザー登録', null, ['class' => 'nav-link']) !!}
				</li>
			@endif
		</ul>

	</div>
</nav>