<script>
    $(function () {
        $(window).on('load scroll', function () {
            if ($(this).scrollTop() > 500 && $('#nav-scroll').hasClass('is-fixed') == false) {
                $('#container').css('margin-top','75px');
                $('#nav-scroll').animate({"top": 47}, 500);
                $('#nav-scroll').addClass('is-fixed');
            } else if($(this).scrollTop() < 500 && $('#nav-scroll').hasClass('is-fixed') == true) {
                $('#container').css('margin-top','');
                $('#nav-scroll').animate({"top": 0}, 0);
                $('#nav-scroll').removeClass('is-fixed');
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
        z-index: 3;
        width: 100%;
    }
    /*セカンドナビのサイドスクロール用*/
    .nav-scroller {
		position: relative;
		z-index: 4;
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