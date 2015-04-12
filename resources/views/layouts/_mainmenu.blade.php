@section('login')

<div class="right menu">

	{!! Form::open([ 'route' => 'session.store', 'class' => 'ui dropdown item' ]) !!}

		Login
		<div class="menu">

			<div class="field">
				<input name="username" type="text" placeholder="Username/email" autofocus>
			</div>

			<div class="field">
				<div class="ui action input">
					<input name="password" placeholder="Passphrase" type="password">
					<a class="ui icon button" href="{{ URL::route('session.create') }}" title="Forgot your username or passphrase?">
						<i class="question icon"></i>
					</a>
				</div>
			</div>

			<div class="inline field">
				<div class="ui checkbox">
					<input id="login-remember" type="checkbox" name="remember" value="remember" checked>
					<label for="login-remember">Remember me</label>
				</div>
			</div>

			{!! Form::button('<i class="sign in icon"></i> Login', [ 'type' => 'submit', 'class' => 'tiny ui fluid primary submit compact labeled icon button', 'title' => 'Remember to sign out if on a public computer!' ]) !!}

		</div>

	{!! Form::close() !!}

	<a class="item" href="{{ URL::route('register') }}" title="Sign up - did we mention it's FREE!">
		Sign up
	</a>

</div>

@stop


@section('mainmenu')

<div id="mainmenu" role="menu" class="ui fixed inverted small main menu">

	<!--
	<a class="logo item" href="/">
		<img class="ui centered mini circular image" src="/assets/img/klubitus_logo.svg">
	</a>
	-->

	<a role="menuitem" class="item" href="/">
		<span class="text hide mobile">Home</span>
	</a>
	<a role="menuitem" class="item{{ $id == 'events' ? ' active' : '' }}" href="{{ URL::route('events') }}">
		Events
	</a>
	<a role="menuitem" class="item{{ $id == 'forum' ? ' active' : '' }}" href="/">
		Forum
	</a>
	<a role="menuitem" class="item{{ $id == 'galleries' ? ' active' : '' }}" href="/">
		Galleries
	</a>
	<a role="menuitem" class="item{{ $id == 'venues' ? ' active' : '' }}" href="/">
		Venues
	</a>
	<a role="menuitem" class="item{{ $id == 'music' ? ' active' : '' }}" href="/">
		Music
	</a>
	<a role="menuitem" class="item{{ $id == 'blogs' ? ' active' : '' }}" href="/">
		Blogs
	</a>
	<a role="menuitem" class="item{{ $id == 'members' ? ' active' : '' }}" href="/">
		Members
	</a>

	@if (!Auth::user())
		@yield('login')
	@else
		@include('layouts._profile')
	@endif

</div><!-- #mainmenu -->

@show
