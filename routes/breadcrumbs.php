<?php

//top
Breadcrumbs::register('top', function($breadcrumbs){
	$breadcrumbs->push('<i class="fas fa-home"></i>トップ', route('top'));
});
//top > login
Breadcrumbs::register('login', function($breadcrumbs){
	$breadcrumbs->parent('top');
	$breadcrumbs->push('<i class="fas fa-sign-in-alt"></i> ログイン/ユーザー登録', route('login.get'));
});
//top > city > [places]
Breadcrumbs::register('city', function($breadcrumbs, $city){
	$breadcrumbs->parent('top');
	$breadcrumbs->push('(広島) <i class="fas fa-map-marker-alt"></i> '.$city->name, route('cities.show', $city));
});
//top > city > place > [show]
Breadcrumbs::register('place', function($breadcrumbs, $place){
	$breadcrumbs->parent('city', $place->city);
	$breadcrumbs->push('<i class="fas fa-map-pin"></i> '.$place->name, route('places.show', $place));
});
//top > tags
Breadcrumbs::register('tags', function($breadcrumbs){
	$breadcrumbs->parent('top');
	$breadcrumbs->push('タグ一覧', route('tags.index'));
});
//top > tag > [places]
Breadcrumbs::register('tag', function($breadcrumbs, $tag){
	$breadcrumbs->parent('top');
	$breadcrumbs->push('<i class="fas fa-tags"></i> '.$tag->name.'スポット', route('tags.show', $tag));
});