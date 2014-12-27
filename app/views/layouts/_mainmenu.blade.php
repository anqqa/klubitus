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

	<div class="ui center aligned basic segment">

		{{ HTML::avatar() }}
		<br>
		<div class="ui inline left pointing dropdown">
			<div class="text">{{ $viewer->username }}</div>
			<i class="dropdown icon"></i>
			<div class="menu" role="menu">
				<a class="item" role="menuitem" href="{{ URL::route('user.profile', [ 'user' => Text::slug($viewer->username) ]) }}"><i class="fa fa-fw fa-user"></i> Profile</a>
				<a class="item" role="menuitem" href="{{ URL::route('forum.messages') }}"><i class="fa fa-fw fa-envelope"></i> Private messages</a>
				<a class="item" role="menuitem" href="{{ URL::route('user.favorites', [ 'user' => Text::slug($viewer->username) ]) }}"><i class="fa fa-fw fa-heart"></i> Favorites</a>
				<a class="item" role="menuitem" href="{{ URL::route('user.friends', [ 'user' => Text::slug($viewer->username) ]) }}"><i class="fa fa-fw fa-group"></i> Friends</a>
				<a class="item" role="menuitem" href="{{ URL::route('user.ignores', [ 'user' => Text::slug($viewer->username) ]) }}"><i class="fa fa-fw fa-ban"></i> Ignores</a>
				<a class="item" role="menuitem" href="{{ URL::route('user.settings', [ 'user' => Text::slug($viewer->username) ]) }}"><i class="fa fa-fw fa-cog"></i> Settings</a>
				<a class="item" role="menuitem" href="{{ URL::route('session.destroy') }}"><i class="fa fa-fw fa-sign-out"></i> Logout</a>
			</div>
		</div>

	</div>

	@endif

	<nav role="navigation" class="ui secondary fluid vertical pointing menu">
		<a role="menuitem" class="item" href="/">
			<i class="home icon"></i>
			klubitus
		</a>
		<a role="menuitem" class="item{{ $id == 'events' ? ' active' : '' }}" href="{{ URL::route('events') }}">
			<i class="calendar icon"></i>
			Events
		</a>
		<a role="menuitem" class="item{{ $id == 'forum' ? ' active' : '' }}" href="/">
			<i class="discussions icon"></i>
			Forum
		</a>
		<a role="menuitem" class="item{{ $id == 'galleries' ? ' active' : '' }}" href="/">
			<i class="photo icon"></i>
			Galleries
		</a>
		<a role="menuitem" class="item{{ $id == 'venues' ? ' active' : '' }}" href="/">
			<i class="marker icon"></i>
			Venues
		</a>
		<a role="menuitem" class="item{{ $id == 'music' ? ' active' : '' }}" href="/">
			<i class="music icon"></i>
			Music
		</a>
		<a role="menuitem" class="item{{ $id == 'blogs' ? ' active' : '' }}" href="/">
			<i class="book icon"></i>
			Blogs
		</a>
		<a role="menuitem" class="item{{ $id == 'members' ? ' active' : '' }}" href="/">
			<i class="users icon"></i>
			Members
		</a>
	</nav>

	<div class="ui centered eboard test ad" data-text="140x350"></div>

</div><!-- #mainmenu -->

@show
