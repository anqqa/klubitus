@section("mainmenu")

<div id="mainmenu" role="menu">

	@if (!$viewer)

	<div class="ui basic segment">
		{{ Form::open([ 'route' => 'session.store' ]) }}

		<div class="ui fluid small form">

			<div class="field">
				<input name="username" type="text" placeholder="Username or email" autofocus>
			</div>

			<div class="field">
				<input name="password" placeholder="Passphrase" type="password">
			</div>

			<div class="inline field">
				<div class="ui checkbox">
					<input id="login-remember" type="checkbox" name="remember" value="remember">
					<label for="login-remember">Remember me</label>
				</div>
			</div>

			{{ Form::button('Login', [ 'type' => 'submit', 'class' => 'tiny ui fluid primary submit button', 'title' => 'Remember to sign out if on a public computer!' ]) }}

		</div>

		{{ Form::close() }}

		<sub>
			<a href="{{ URL::route('session.create') }}" class="text-muted">You don't remember you?</a>
		</sub>

		<hr>

		<a class="tiny ui fluid facebook button" href="{{ URL::route('facebook-login') }}"title="Sign in with your Facebook account">
			<i class="icon facebook"></i> Facebook
		</a>

		<a class="tiny ui fluid pink button" href="{{ URL::route('register') }}" title="Did we mention it's FREE!">
			<i class="icon heart"></i> Sign up
		</a>
	</div>

	@else

			<li id="notifications"></li>

			<li class="hidden-xs avatar">
				{{ HTML::avatar() }}
			</li>

			<li id="visitor" class="dropdown">
				<a class="user dropdown-toggle" href="#menu-profile" data-toggle="dropdown">
					<span class="hidden-sm">{{{ $viewer->username }}}</span>
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu pull-right" role="menu">
					<li role="menuitem">
						<a href="{{ URL::route('user.profile', [ 'user' => Text::slug($viewer->username) ]) }}"><i class="fa fa-fw fa-user"></i> Profile</a>
						<a href="{{ URL::route('forum.messages') }}"><i class="fa fa-fw fa-envelope"></i> Private messages</a>
						<a href="{{ URL::route('user.favorites', [ 'user' => Text::slug($viewer->username) ]) }}"><i class="fa fa-fw fa-heart"></i> Favorites</a>
						<a href="{{ URL::route('user.friends', [ 'user' => Text::slug($viewer->username) ]) }}"><i class="fa fa-fw fa-group"></i> Friends</a>
						<a href="{{ URL::route('user.ignores', [ 'user' => Text::slug($viewer->username) ]) }}"><i class="fa fa-fw fa-ban"></i> Ignores</a>
						<a href="{{ URL::route('user.settings', [ 'user' => Text::slug($viewer->username) ]) }}"><i class="fa fa-fw fa-cog"></i> Settings</a>
						<a href="{{ URL::route('session.destroy') }}"><i class="fa fa-fw fa-sign-out"></i> Logout</a>
					</li>
				</ul>
			</li>

			@endif

	<nav role="navigation" class="ui secondary fluid vertical pointing menu">
		<a role="menuitem" class="item" href="/">
			klubitus
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
	</nav>

</div><!-- #mainmenu -->

@show
