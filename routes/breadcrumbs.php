<?php

//top
Breadcrumbs::register('top', function($breadcrumbs){
	$breadcrumbs->push('トップ', route('top'), ['icon' => '<i class="fas fa-home"></i>']);
});
//top > login
Breadcrumbs::register('login', function($breadcrumbs){
	$breadcrumbs->parent('top');
	$breadcrumbs->push('ログイン/ユーザー登録', route('login'), ['icon' => '<i class="fas fa-sign-in-alt"></i>']);
});
//top > history > [places]
Breadcrumbs::register('history_place', function($breadcrumbs){
	$breadcrumbs->parent('top');
	$breadcrumbs->push('最近見たスポット', route('history.places'), ['icon' => '<i class="fas fa-history"></i>']);
});
//top > history > [search]
Breadcrumbs::register('history.search', function($breadcrumbs){
	$breadcrumbs->parent('top');
	$breadcrumbs->push('最近検索したワード', route('history.search'), ['icon' => '<i class="fas fa-history"></i>']);
});
//top > Search
Breadcrumbs::register('search', function($breadcrumbs, $keywords = null, $tagword = null){
	$breadcrumbs->parent('top');
	if (!empty($keywords && $tagword)){
		$breadcrumbs->push('" '.$keywords.' " で " '.$tagword.' " タグを含むスポット', route('search'), ['icon' => '<i class="fas fa-search"></i>']);
	} elseif (!empty($keywords)) {
		$breadcrumbs->push('" '.$keywords.' " を含むスポット', route('search'), ['icon' => '<i class="fas fa-search"></i>']);
	} else {
		$breadcrumbs->push('検索スポット', route('search'), ['icon' => '<i class="fas fa-search"></i>']);
	}
});
//top > city > [places]
Breadcrumbs::register('city', function($breadcrumbs, $city){
	$breadcrumbs->parent('top');
	$breadcrumbs->push($city->name, route('cities.show', $city->id), ['icon' => '(広島) <i class="fas fa-map-marker-alt"></i>']);
});
//top > city > place > [show]
Breadcrumbs::register('place', function($breadcrumbs, $place){
	$breadcrumbs->parent('city', $place->city);
	$breadcrumbs->push($place->name, route('places.show', $place->id), ['icon' => '<i class="fas fa-map-pin"></i>']);
});
//top > city > place > [show] > reviews
Breadcrumbs::register('review', function($breadcrumbs, $place){
	$breadcrumbs->parent('place', $place);
	$breadcrumbs->push('口コミ一覧', route('place.reviews', $place->id), ['icon' => '<i class="far fa-comment"></i>']);
});
//top > city > place > [show] > photos
Breadcrumbs::register('photo', function($breadcrumbs, $place){
	$breadcrumbs->parent('place', $place);
	$breadcrumbs->push('フォト一覧', route('place.photos', $place->id), ['icon' => '<i class="fas fa-camera-retro"></i>']);
});
//top > city > place > [show] > map
Breadcrumbs::register('map', function($breadcrumbs, $place){
	$breadcrumbs->parent('place', $place);
	$breadcrumbs->push('マップ', route('place.map', $place->id), ['icon' => '<i class="fas fa-map-marked-alt"></i>']);
});
//top > tags
Breadcrumbs::register('tags', function($breadcrumbs){
	$breadcrumbs->parent('top');
	$breadcrumbs->push('タグ一覧', route('tags.index'), ['icon' => '<i class="fas fa-tags"></i>']);
});
//top > tag > [places]
Breadcrumbs::register('tag', function($breadcrumbs, $tag){
	$breadcrumbs->parent('top');
	$breadcrumbs->push($tag->name.'スポット', route('tags.show', $tag), ['icon' => '<i class="fas fa-tag"></i>']);
});