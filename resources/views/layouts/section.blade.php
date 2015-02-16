<section id="{{ $id or '' }}" class="{{ $class or '' }}" role="{{ $role or '' }}">
	<header>

	@section('header')
		@if (isset($title))
		<h3>{{ $title }}</h3>
		@endif
		@if (isset($subtitle))
		<p>{{ $subtitle }}</p>
		@endif
	@show

	</header>

	<div class="body">

		@yield('content')

	</div>
</section>
