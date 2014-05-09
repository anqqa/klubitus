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

	@include('layouts._mainmenu')


<!-- ADS -->

@yield('ads.top')

<!-- /ADS -->


<!-- CONTENT -->

@include('layouts._title')

@if (isset($top))
<div class="content {{{ $topClass or '' }}}">
	<div class="container">
		<div class="row">

@section('top')
@show

		</div>
	</div>
</div>
@endif

<div class="content {{{ $centerClass or '' }}}">
	<div class="container">
		<div class="row">

@section('left')
@show

@section('center')
@show

@section('right')
@show

		</div>
	</div>
</div>

@if (isset($bottom))
<div class="content {{{ $bottomClass or '' }}}">
	<div class="container">
		<div class="row">

@section('bottom')
@show

		</div>
	</div>
</div>
@endif

<!-- /CONTENT -->


<footer id="footer" class="dark content">
	<div class="container">

@include('layouts._footer')

	</div>
</footer><!-- #footer -->

@include('layouts._foot')

</body>

</html>
