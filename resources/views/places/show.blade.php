@extends('layouts.app')

@section('title', $place->name.'の口コミ･評価')

@section('navbar')
	@include('commons.navbar')
@endsection

@section('breadcrumbs')
	<nav area-label="breadcrumbs-list">
		<div class="row mb-2 bg-primary border-top">
			<ol class="breadcrumb container my-0">
			{!! Html::decode(Breadcrumbs::render('place', $place)) !!}
			</ol>
		</div>
	</nav>
@endsection

@section('content')
<div class="placehead container">
{{-- 	<nav>
		<ol class="cd-breadcrumb cd-multi-steps text-bottom count">
			<li class="visited"><a href="#0">Home</a></li>
			<li class="current"><em>Gallery</em></li>
			<li><em>Web</em></li>
			<li><em>Project</em></li>
		</ol>
	</nav> --}}
	<div class="row mt-3">
		<div class="col px-2">
			<div class="card">
				<img class="card-img-top" src="..." alt="カードの画像">
				<div class="card-body clearfix">
					<P class="float-right"><i class="far fa-star fa-2x"></i></p>
					<h5 class="card-title">{{ $place->name }}</h5>
					<p class="card-text">＜口コミ平均点＞＜口コミ件数＞</p>
					<p class="card-text">＜タグ＞やplaceに関する関連情報</p>
					<p class="card-text"><small class="text-muted">最終更新3分前</small></p>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="navbar bg-dark my-3 px-1 pb-0" id="nav-scroll">
	<div class="nav-scroller box-shadow mx-auto">
		<nav class="nav-underline">
			<ul class="nav nav-tabs">
				<li class="nav-item"><a href="#" class="nav-link active">概要</a></li>
				<li>
					<a class="nav-link" href="#">
                    <i class="far fa-comments fa-lg"></i> <span>レビュー</span>
                    <span class="badge badge-pill bg-light align-text-bottom text-secondary">27</span>
                    </a>
                </li>
				<li class="nav-item"><a href="#" class="nav-link"><i class="far fa-images fa-lg"></i> <span>フォト</span></a></li>
				<li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-map-marker-alt fa-lg"></i> <span>マップ</span></a></li>
				<li class="nav-item"><a href="#" class="nav-link"  data-offset="0,5" data-placement="right" data-toggle="tooltip" title="マップ"><i class="fas fa-map-marker-alt fa-lg"></i></a></li>
				<li class="nav-item"><a href="#" class="nav-link">リンク1</a></li>
				<li class="nav-item"><a href="#" class="nav-link">リンク2</a></li>
				<li class="nav-item"><a href="#" class="nav-link disabled">無効</a></li>
			</ul>
		</nav>
	</div>
</div>
<div class="container px-2" style="height:1000px;" id="container">
	<div class="content row">
		<div class="content-main col-md-8">
			{{-- ここから review --}}
			<div class="review card my-2">
				<div class="card-header text-center">
					<div class="">
						<div class="fa-5x text-secondary">
							<i class="far fa-comment-dots fa-flip-horizontal"></i>
						</div>
						<h3>{{ $place->name }}の口コミ <span class="badge badge-pill bg-light align-text-bottom text-secondary">27</span></h3>
					</div>
				</div>
				<div class="card-body">
					<div class="media mt-2 border-bottom">
						<a href="#" class="mr-3">
							<img src="..." alt="顔アイコン">
						</a>
						<div class="media-body">
							<div class="" id="p-show-kuti">
								口コミ文がここに入る　口コミ文がここに入る　口コミ文がここに入る　口コミ文がここに入る　口コミ文がここに入る　口コミ文がここに入る　口コミ文がここに入る　口コミ文がここに入る　（途中表示を・・・にする）
							</div>
							<div>
								<P class="mt-0 text-right">＜口コミ平均点＞</P>
							</div>
						</div><!-- /.media-body -->
					</div><!-- /.media -->
				</div>
				<div class="card-footer">
					全ての口コミ（〇〇件）を見る（ボタンタイプ）
				</div>
			</div>
			{{-- ここから photo --}}
			<div class="photo card my-2">
				<div class="card-header text-center">
					<div class="">
						<div class="fa-5x text-secondary">
							<i class="far fa-images"></i>
						</div>
						<h3>{{ $place->name }}のフォト <span class="badge badge-pill bg-light align-text-bottom text-secondary">27</span></h3>
					</div>
				</div>
				<div class="card-body">
					ここにフォト（フォトの配列方法、表示方法は要検討）
				</div>
				<div class="card-footer">
					全てのフォト（〇〇件）を見る（ボタンタイプ）
				</div>
			</div>
			{{-- ここから map --}}
			<div class="map card my-2">
				<div class="card-header text-center">
					<div class="">
						<div class="fa-5x text-secondary">
							<i class="fas fa-map-marker-alt" data-fa-transform="shrink-9 down-2 right-2" data-fa-mask="fas fa-map"></i>
						</div>
						<h3>{{ $place->name }}のマップ <span class="badge badge-pill bg-light align-text-bottom text-secondary">27</span></h3>
					</div>
				</div>
				<div class="card-body">
					ここにマップ（googleマップAPI活用予定）方法はまだ不明
				</div>
				<div class="card-footer">
					フッターの仕様用途未定
				</div>
			</div>
		</div>
		{{-- ここから sidecolumn --}}
		<div class="content-side col-md-4">
			<div class="card my-2">
				<h5 class="card-header">ヘッダのタイトル</h5>
				<div class="card-body">
					コンテンツ
				</div>
				<div class="card-footer">フッタ</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scroll')
	<script>
        $(function () {
            $(window).scroll(function () {
                if ($(this).scrollTop() > 232) {
                    $('#nav-scroll').addClass('is-fixed');
                    $('#container').css('margin-top','5.6rem');
                } else {
                    $('#nav-scroll').removeClass('is-fixed');
                    $('#container').css('margin-top','');
                }
            });
        });
    </script>
    <style>
        /*スクロールしたら、このCSSを適用し、ナビゲーションバーの位置を固定する*/
        .is-fixed {
            position: fixed;
            top: 47px;
            left: 0;
            z-index: 1;
            width: 100%;
        }
        /*セカンドナビのサイドすくルール用*/
        .nav-scroller {
			position: relative;
			z-index: 2;
			height: 3rem;
			overflow-y: hidden;
        }

        .nav-scroller .nav {
			display: -ms-flexbox;
			display: flex;
			-ms-flex-wrap: nowrap;
			flex-wrap: nowrap;
			padding-bottom: 1rem;
			margin-top: -1px;
			overflow-x: auto;
			text-align: center;
			white-space: nowrap;
			-webkit-overflow-scrolling: touch;
        }

        .nav-underline .nav-link {
			padding-top: .5rem;
			padding-bottom: .75rem;
			padding-left: 1.4rem;
			padding-right: 1.4rem;
			font-size: 1.2rem;
			color: #fff;
        }

        .nav-underline .nav-link:hover {
			background: #fff;
			color: #F3969A;
        }

        .nav-underline .active {
			font-weight: 1000;
			color: #F3969A;
        }
    </style>
@endsection