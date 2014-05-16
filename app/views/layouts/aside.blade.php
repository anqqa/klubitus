<aside id="{{ $id or '' }}" class="panel panel-default {{ $class or '' }}" role="{{ $role or '' }}">
	<header class="panel-heading">

	@section('header')
		@if (isset($title))
		<h3>{{ $title }}</h3>
		@endif
		@if (isset($subtitle))
		<p>{{ $subtitle }}</p>
		@endif
	@show

	</header>

	<div class="panel-body">

		@yield('content')

	</div>
</aside>
