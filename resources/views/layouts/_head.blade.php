<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<title>{{ $title or 'klubitus' }}</title>

	@yield('meta')

	<link href="/assets/semantic.min.css" rel="stylesheet">

	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="/assets/semantic.min.js"></script>

<!--	{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css') }}
	{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/select2/3.4.5/select2.min.css') }}
	{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/select2/3.4.5/select2-bootstrap.css') }}

	{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/headjs/1.0.3/head.load.js') }}-->

	<script src="{{ App::environment('dev') ? '/assets/js/klubitus.js' : '/assets/js/klubitus.min.js' }}"></script>

	@yield('ads.head')

</head>
