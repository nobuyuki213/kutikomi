<!DOCTYPE html>
<html lang="jp">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>@yield('title')-kuticomi</title>

		<!-- Bootstrap CSS -->
		{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" id="bootstrap-css"> --}}

		@yield('stylesheet')

		{{-- My CSS --}}
		<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css')}}">

		{{-- Minty CSS --}}
		<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.1/minty/bootstrap.min.css" rel="stylesheet" integrity="sha384-4eGtnTOp6je5m6l1Zcp2WUGR9Y7kJZuAiD3Pk2GAW3uNRgHQSIqcrcAxBipzlbWP" crossorigin="anonymous">

		<!--Font Awesome-->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

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
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
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
		@yield('script')
	</body>

</html>