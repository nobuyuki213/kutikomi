<!DOCTYPE html>
<html lang="jp">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>@yield('title')-kuticomi</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" id="bootstrap-css">

		@if (Request::is('hirosima/*'))
			<style type="text/css">
			body{background:#f9f9f9;}
			#wrapper{padding:1.5rem 0;}
			.navbar-expand-lg .navbar-nav.side-nav{flex-direction: column;}
			.card{margin-bottom: 15px; border-radius:0; box-shadow: 0 3px 5px rgba(0,0,0,.1); }
/*			.header-top{box-shadow: 0 3px 5px rgba(0,0,0,.1)}
*/
			@media(min-width:992px) {
			#wrapper{margin-left: 300px;padding: 1.5rem 15px 15px;}
			.navbar-nav.side-nav{background: #F3969A;box-shadow: 2px 1px 2px rgba(0,0,0,.1);position:fixed;top:56px;flex-direction: column!important;left:0;width:300px;overflow-y:auto;bottom:0;overflow-x:hidden;padding-bottom:40px}
			}
			</style>
		@endif

		<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css')}}">

		{{-- Minty css --}}
		<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.1/minty/bootstrap.min.css" rel="stylesheet" integrity="sha384-4eGtnTOp6je5m6l1Zcp2WUGR9Y7kJZuAiD3Pk2GAW3uNRgHQSIqcrcAxBipzlbWP" crossorigin="anonymous">

		<!--Font Awesome-->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">

		{{-- Social Buttons for Bootstrap --}}
		<link rel="stylesheet" href="{{ asset('css/bootstrap-social.css')}}">


	</head>


	<body style="padding-top: 3rem;">
		@if (Request::is('hirosima/*'))
		<div id="wrapper">
			<header id="header">

				@include('commons.admin_navbar')

			</header><!-- /header -->

			<div class="container-fluid">

				@yield('content_f')

			</div>
		</div>
		@else
			<header id="header">

				@include('commons.navbar')

			</header><!-- /header -->

				@yield('cover')

			<div class="container">

				@yield('content')

			</div>
		@endif

		<!-- jQuery -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
		<!-- Popper JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
		<!-- Bootstrap JS -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

		<script>
		$(function() {
			$('#provider0').on('change', function(){
				if ($(this).is(':checked')) {
				//チェックが入ったら、送信ボタンを押せる
				$('#submitBtn0').prop('disabled', false);
				} else {
				//チェックが入っていなかったら、送信ボタンを押せない
				$('#submitBtn0').prop('disabled', true);
				}
			});
		});
		</script>
	</body>

</html>