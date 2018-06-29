<!DOCTYPE html>
<html lang="jp">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>@yield('title')-kuticomi</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" id="bootstrap-css">

		@yield('stylesheet')
		{{-- My css --}}
		<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css')}}">

		{{-- Minty css --}}
		<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.1/minty/bootstrap.min.css" rel="stylesheet" integrity="sha384-4eGtnTOp6je5m6l1Zcp2WUGR9Y7kJZuAiD3Pk2GAW3uNRgHQSIqcrcAxBipzlbWP" crossorigin="anonymous">

		<!--Font Awesome-->
		<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js"></script>

		{{-- Social Buttons for Bootstrap --}}
		<link rel="stylesheet" href="{{ asset('css/bootstrap-social.css')}}">
	</head>

	<body style="padding-top: 4.5rem;">

		<div id="wrapper" class="px-0">
			<header id="header">

				@yield('navbar')

			</header><!-- /header -->
			<main>

				@yield('breadcrumbs')

				@yield('cover')

				@yield('content')

			</main>
		</div>

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
		<script>
			$('[data-toggle="popover"]').popover()
		</script>
		<script>
			$('[data-toggle="tooltip"]').tooltip()
		</script>
		@yield('scroll')
	</body>

</html>