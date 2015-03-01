<!doctype html>
<html lang="{{{ $language }}}">

@include('layouts._head')

<body id="{{{ $id }}}" class="{{{ $class }}}">

	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', '{{{ Config::get("3rdparty.google.ua") }}}', '{{{ Config::get("3rdparty.google.domain") }}}');
	  ga('send', 'pageview');
	</script>

	<div id="body">

		@include('layouts._mainmenu')

		<div id="content">

<!-- ADS -->

@yield('ads.top')

<!-- /ADS -->


<!-- CONTENT -->

@if (Session::has('message'))
<div id="messages" class="container">
	<p class="alert">{{ Session::get('message') }}</p>
</div>
@endif

@include('layouts._title')

{!! $content or '' !!}

<!-- /CONTENT -->


<footer id="footer" class="dark content">
	<div class="container">

@include('layouts._footer')

	</div>
</footer><!-- #footer -->

		</div>

	</div>

@include('layouts._foot')

</body>

</html>
