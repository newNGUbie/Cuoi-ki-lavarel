<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ config('app.name') }}</title>
	<link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ asset('source/assets/dest/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('source/assets/dest/vendors/colorbox/example3/colorbox.css') }}">
	<link rel="stylesheet" href="{{ asset('source/assets/dest/rs-plugin/css/settings.css') }}">
	<link rel="stylesheet" href="{{ asset('source/assets/dest/rs-plugin/css/responsive.css') }}">
	<link rel="stylesheet" title="style" href="{{ asset('source/assets/dest/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('source/assets/dest/css/animate.css') }}">
	<link rel="stylesheet" title="style" href="{{ asset('source/assets/dest/css/huong-style.css') }}">
	<link rel="stylesheet" href="{{ asset('source/assets/dest/css/houseware-ui.css') }}">
</head>
<body>

	@include('layout.header')

	@if(session('success'))
		<div class="container" style="margin-top: 10px;">
			<div class="alert alert-success">{{ session('success') }}</div>
		</div>
	@endif
	@if(session('error'))
		<div class="container" style="margin-top: 10px;">
			<div class="alert alert-danger">{{ session('error') }}</div>
		</div>
	@endif

	<div class="rev-slider">
		@yield('banner')
	</div>

	<div id="content">
		@yield('content')
	</div> <!-- #content -->

	@include('layout.footer')


	<!-- include js files -->
	<script src="{{ asset('source/assets/dest/js/jquery.js') }}"></script>
	<script src="{{ asset('source/assets/dest/vendors/jqueryui/jquery-ui-1.10.4.custom.min.js') }}"></script>
	<script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	<script src="{{ asset('source/assets/dest/vendors/bxslider/jquery.bxslider.min.js') }}"></script>
	<script src="{{ asset('source/assets/dest/vendors/colorbox/jquery.colorbox-min.js') }}"></script>
	<script src="{{ asset('source/assets/dest/vendors/animo/Animo.js') }}"></script>
	<script src="{{ asset('source/assets/dest/vendors/dug/dug.js') }}"></script>
	<script src="{{ asset('source/assets/dest/js/scripts.min.js') }}"></script>
	<script src="{{ asset('source/assets/dest/rs-plugin/js/jquery.themepunch.tools.min.js') }}"></script>
	<script src="{{ asset('source/assets/dest/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>
	<script src="{{ asset('source/assets/dest/js/waypoints.min.js') }}"></script>
	<script src="{{ asset('source/assets/dest/js/wow.min.js') }}"></script>
	<script src="{{ asset('source/assets/dest/js/custom2.js') }}"></script>

	<script>
	$(document).ready(function($) {
		$(window).scroll(function(){
			if($(this).scrollTop()>150){
				$(".header-bottom").addClass('fixNav')
			}else{
				$(".header-bottom").removeClass('fixNav')
			}
		})
	})
	</script>

	@if(config('services.messenger.page_id'))
		<div id="fb-root"></div>
		<div id="fb-customer-chat" class="fb-customerchat"></div>
		<script>
			var chatbox = document.getElementById('fb-customer-chat');
			chatbox.setAttribute('page_id', {!! json_encode(config('services.messenger.page_id')) !!});
			chatbox.setAttribute('attribution', 'biz_inbox');
			window.fbAsyncInit = function() {
				FB.init({
					xfbml: true,
					version: 'v19.0'
				});
			};
			(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>
	@elseif(config('services.messenger.page_url'))
		<a href="{{ config('services.messenger.page_url') }}" target="_blank" rel="noopener" style="position: fixed; right: 18px; bottom: 18px; z-index: 9999; background: #0084ff; color: #fff; width: 54px; height: 54px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(0,0,0,.22); font-size: 24px;" title="Chat Messenger">
			<i class="fa fa-comments"></i>
		</a>
	@endif
</body>
</html>
