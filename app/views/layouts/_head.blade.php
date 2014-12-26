<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<title>{{{ $title or 'klubitus' }}}</title>

	@yield('meta')

	{{ HTML::style('assets/semantic.min.css') }}
	{{ HTML::script('assets/semantic.min.js') }}
<!--	{{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css') }}
	{{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/select2/3.4.5/select2.min.css') }}
	{{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/select2/3.4.5/select2-bootstrap.css') }}

	{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/headjs/1.0.3/head.load.js') }}-->

	@yield('ads.head')

</head>
